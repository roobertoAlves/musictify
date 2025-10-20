// Carrega estações populares globais (default)
async function loadPopularStations() {
	try {
		const res = await fetch('/musictify/app/controllers/ChannelController.php?action=list&countrycode=ALL&limit=30');
		const stations = await res.json();
		openRadioPanel({name:'Mundo'}, stations, {name:'Mais populares do mundo'});
	} catch(err) {
		alert('Não foi possível carregar rádios populares.');
	}
}

// ========== MAPA E MARCADORES DE CIDADES COM RÁDIO ==========
var map = L.map('map', { zoomControl: true, minZoom:2 }).setView([20,0], 2);
L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}@2x.png', {
	attribution: '&copy; OpenStreetMap & CartoDB',
	maxZoom: 19
}).addTo(map);

let cityMarkers = [];
let selectedMarker = null;

// Carrega cidades com rádio (exemplo: top 200 cidades)
async function loadRadioCities() {
	try {
		const res = await fetch('/musictify/app/controllers/PlaceController.php?action=countries');
		const countries = await res.json();
		for (const country of countries) {
			const resCities = await fetch(`/musictify/app/controllers/PlaceController.php?action=cities&countrycode=${country.iso_3166_1}`);
			const cities = await resCities.json();
			for (const city of cities) {
				if(city.latitude && city.longitude && city.stationcount > 0) {
					const marker = L.circleMarker([city.latitude, city.longitude], {
						radius: Math.min(12, 4 + Math.log2(city.stationcount+1)*2),
						color: '#00ff99',
						fillColor: '#00ff99',
						fillOpacity: 0.85,
						weight: 2,
						className: 'radio-marker'
					}).addTo(map);
					marker.city = city;
					marker.country = country;
					marker.on('click', () => onCityMarkerClick(city, country, marker));
					cityMarkers.push(marker);
				}
			}
		}
	} catch(err) {
		alert('Não foi possível carregar cidades com rádio.');
	}
}

// Ao clicar em uma cidade, mostra painel lateral com rádios da cidade
async function onCityMarkerClick(city, country, marker) {
	if(selectedMarker) selectedMarker.setStyle({ color: '#00ff99', fillColor: '#00ff99' });
	selectedMarker = marker;
	marker.setStyle({ color: '#BF2C38', fillColor: '#BF2C38' });
	map.setView([city.latitude, city.longitude], 8);
	try {
		const resStations = await fetch(`/musictify/app/controllers/ChannelController.php?action=listByCity&countrycode=${country.iso_3166_1}&city=${encodeURIComponent(city.name)}&limit=20`);
		const stations = await resStations.json();
		openCityPanel(country, city, stations);
	} catch(err) {
		alert('Não foi possível carregar rádios da cidade.');
	}
}

// Painel lateral igual ao Radio Garden
function openRadioPanel(place, channels, details) {
	const panel = document.getElementById('side-panel');
	const panelBody = document.getElementById('panel-body');
	const panelTitle = document.getElementById('panel-title');
	panel.style.display = 'block';
	panel.setAttribute('aria-hidden','false');
	panelTitle.innerText = details.name || place.name;
	let html = [];
	// Estações do local
	html.push(`<div class="panel-card"><div style="font-weight:700">Estações em ${details.name || place.name}</div><div style="margin-top:8px;">${channels.map(ch => `<div class="mb-2"><button class="btn btn-sm btn-outline-light btn-radio-play" data-id="${ch.id}" data-name="${ch.name}" data-place="${details.name || place.name}"><i class="fa fa-play"></i></button> <span style="font-weight:600">${ch.name}</span></div>`).join('')}</div></div>`);
	// Seleções da área
	if(channels.length > 0) {
		html.push(`<div class="panel-card"><div style="font-weight:700">Seleções da área</div><ul style="margin-top:8px">${channels.map(ch => `<li>${ch.name} (${details.name || place.name})</li>`).join('')}</ul></div>`);
	}
	// Populares do país (real)
	html.push(`<div class="panel-card" id="panel-popular"><div style="font-weight:700">Popular no país</div><ul style="margin-top:8px"><li>Carregando...</li></ul></div>`);
	// Cidades próximas (real)
	html.push(`<div class="panel-card" id="panel-nearby"><div style="font-weight:700">Cidades próximas</div><ul style="margin-top:8px"><li>Carregando...</li></ul></div>`);
	panelBody.innerHTML = html.join('');
	// Play rádio
	document.querySelectorAll('.btn-radio-play').forEach(btn => {
		btn.addEventListener('click', () => {
			playRadioInFooter(btn.dataset.id, btn.dataset.name, btn.dataset.place);
		});
	});
	// Buscar populares do país
	if(details.countryCode) {
		fetch(`/musictify/app/controllers/ChannelController.php?action=popular&countryCode=${details.countryCode}`)
			.then(res => res.json())
			.then(populars => {
				const ul = document.querySelector('#panel-popular ul');
				if(populars.length > 0) {
					ul.innerHTML = populars.map(ch => `<li><button class='btn btn-sm btn-outline-light btn-radio-play' data-id='${ch.id}' data-name='${ch.name}' data-place='${ch.placeName || details.name || place.name}'><i class='fa fa-play'></i></button> <span style='font-weight:600'>${ch.name}</span></li>`).join('');
					ul.querySelectorAll('.btn-radio-play').forEach(btn => {
						btn.addEventListener('click', () => {
							playRadioInFooter(btn.dataset.id, btn.dataset.name, btn.dataset.place);
						});
					});
				} else {
					ul.innerHTML = '<li>Nenhuma rádio popular encontrada.</li>';
				}
			})
			.catch(()=>{
				const ul = document.querySelector('#panel-popular ul');
				ul.innerHTML = '<li>Erro ao buscar rádios populares.</li>';
			});
	}
	// Buscar cidades próximas
	if(place.latitude && place.longitude) {
		fetch(`/musictify/app/controllers/PlaceController.php?action=nearby&lat=${place.latitude}&lng=${place.longitude}`)
			.then(res => res.json())
			.then(cities => {
				const ul = document.querySelector('#panel-nearby ul');
				if(cities.length > 0) {
					ul.innerHTML = cities.map(city => `<li><span style='font-weight:600'>${city.name}</span> <span class='muted'>(${city.countryName})</span></li>`).join('');
				} else {
					ul.innerHTML = '<li>Nenhuma cidade próxima encontrada.</li>';
				}
			})
			.catch(()=>{
				const ul = document.querySelector('#panel-nearby ul');
				ul.innerHTML = '<li>Erro ao buscar cidades próximas.</li>';
			});
	}
}

// Player do rodapé
async function playRadioInFooter(channelId, name, place) {
	try {
		const res = await fetch(`/musictify/app/controllers/ChannelController.php?action=stream&channelId=${channelId}`);
		const data = await res.json();
		const audio = new Audio();
		audio.src = data.streamUrl;
		audio.crossOrigin = "anonymous";
		audio.play().catch(()=>{});
		document.getElementById('player-art').src = 'https://picsum.photos/seed/radio/60/60';
		document.getElementById('player-title').innerText = name || '—';
		document.getElementById('player-artist').innerText = place || '';
	} catch(err) {
		alert('Não foi possível tocar a rádio.');
	}
}

// Botão explorar
document.querySelector('.nav-icon.fa-search').addEventListener('click', () => {
	document.getElementById('side-panel').style.display = 'block';
	document.getElementById('side-panel').setAttribute('aria-hidden','false');
});

// Inicialização: carrega marcadores de cidades e painel explorar mostra populares globais
loadRadioCities();
document.querySelector('.nav-icon.fa-search').addEventListener('click', () => {
	loadPopularStations();
	document.getElementById('side-panel').style.display = 'block';
	document.getElementById('side-panel').setAttribute('aria-hidden','false');
});
// Ao abrir, mostra populares globais
loadPopularStations();

// ...existing code...
// Removido bloco duplicado de inicialização do mapa
let geojsonLayer = null;
let selectedLayer = null;

/* Style functions */
function countryStyle(feature){
	return {
		color: 'rgba(255,255,255,0.06)',
		weight: 1,
		fillColor: '#ffffff',
		fillOpacity: 0.02
	};
}
function highlightStyle(){
	return { weight: 2, color: 'var(--accent)', fillOpacity: 0.12 };
}

/* ========== LOAD GEOJSON (countries dataset) ==========
	 Source: https://raw.githubusercontent.com/datasets/geo-countries/master/data/countries.geojson
	 (contains property: ADMIN = country common name)
	// Estações do local
	html.push(`
	<div class="panel-card radio-section">
	  <div class="panel-section-title"><i class="fa fa-broadcast-tower"></i> Estações em <span class="accent">${details.name || place.name}</span></div>
	  <div class="radio-list">${channels.map(ch => `
		<div class="mb-2 radio-item">
		  <button class="btn btn-sm btn-accent btn-radio-play" data-id="${ch.id}" data-name="${ch.name}" data-place="${details.name || place.name}"><i class="fa fa-play"></i></button>
		  <span class="radio-title">${ch.name}</span>
		</div>`).join('')}
	  </div>
	</div>`);
	// Populares do país (real)
	html.push(`
	<div class="panel-card" id="panel-popular">
	  <div class="panel-section-title"><i class="fa fa-star"></i> Populares no país</div>
	  <ul class="popular-list"><li>Carregando...</li></ul>
	</div>`);
	// Cidades próximas (real)
	html.push(`
	<div class="panel-card" id="panel-nearby">
	  <div class="panel-section-title"><i class="fa fa-map-marker-alt"></i> Cidades próximas</div>
	  <ul class="nearby-list"><li>Carregando...</li></ul>
	</div>`);
	panelBody.innerHTML = html.join('');
	// Play rádio
	document.querySelectorAll('.btn-radio-play').forEach(btn => {
		btn.addEventListener('click', () => {
			playRadioInFooter(btn.dataset.id, btn.dataset.name, btn.dataset.place);
		});
	});
	// Buscar populares do país
	if(details.countryCode) {
		fetch(`/musictify/app/controllers/ChannelController.php?action=popular&countryCode=${details.countryCode}`)
			.then(res => res.json())
			.then(populars => {
				const ul = document.querySelector('#panel-popular .popular-list');
				if(populars.length > 0) {
					ul.innerHTML = populars.map(ch => `<li class='popular-radio'><button class='btn btn-xs btn-accent btn-radio-play' data-id='${ch.id}' data-name='${ch.name}' data-place='${ch.placeName || details.name || place.name}'><i class='fa fa-play'></i></button> <span class='radio-title'>${ch.name}</span></li>`).join('');
					ul.querySelectorAll('.btn-radio-play').forEach(btn => {
						btn.addEventListener('click', () => {
							playRadioInFooter(btn.dataset.id, btn.dataset.name, btn.dataset.place);
						});
					});
				} else {
					ul.innerHTML = '<li class="muted">Nenhuma rádio popular encontrada.</li>';
				}
			})
			.catch(()=>{
				const ul = document.querySelector('#panel-popular .popular-list');
				ul.innerHTML = '<li class="muted">Erro ao buscar rádios populares.</li>';
			});
	}
	// Buscar cidades próximas
	if(place.latitude && place.longitude) {
		fetch(`/musictify/app/controllers/PlaceController.php?action=nearby&lat=${place.latitude}&lng=${place.longitude}`)
			.then(res => res.json())
			.then(cities => {
				const ul = document.querySelector('#panel-nearby .nearby-list');
				if(cities.length > 0) {
					ul.innerHTML = cities.map(city => `<li class='nearby-city'><i class='fa fa-map-marker-alt accent'></i> <span class='city-title'>${city.name}</span> <span class='muted'>(${city.countryName})</span></li>`).join('');
				} else {
					ul.innerHTML = '<li class="muted">Nenhuma cidade próxima encontrada.</li>';
				}
			})
			.catch(()=>{
				const ul = document.querySelector('#panel-nearby .nearby-list');
				ul.innerHTML = '<li class="muted">Erro ao buscar cidades próximas.</li>';
			});
	}
	}
	try {
		const res = await fetch(`/musictify/app/data/${geojsonFile}`);
		if(!res.ok) throw new Error('Falha ao buscar GeoJSON de estados');
		const geo = await res.json();
		// Adiciona camada de estados
		window.stateLayer = L.geoJSON(geo, {
			style: function(feature){
				return {
					color: 'rgba(255,255,255,0.12)',
					weight: 1.5,
					fillColor: '#BF2C38',
					fillOpacity: 0.08
				};
			},
			onEachFeature: function(feature, layer){
				const stateName = feature.properties.name || feature.properties.NOME || feature.properties.STATE || 'Estado';
				layer.bindTooltip(stateName, { direction:'center', className:'country-tooltip', permanent:false, opacity:0.9 });
				layer.on({
					mouseover: () => layer.setStyle({ weight: 3, color: 'var(--accent)', fillOpacity: 0.18 }),
					mouseout: () => window.stateLayer.resetStyle(layer),
					click: () => onStateClick(stateName, layer)
				});
			}
		}).addTo(map);
		// Zoom para o bounding box dos estados
		map.fitBounds(window.stateLayer.getBounds(), { maxZoom: 6, padding: [40,40] });
	} catch(err){
		alert('Não foi possível carregar estados/províncias deste país.');
	}
}

function onStateClick(stateName, layer) {
	if(window.selectedStateLayer) window.stateLayer.resetStyle(window.selectedStateLayer);
	window.selectedStateLayer = layer;
	layer.setStyle({ weight: 3, color: 'var(--accent)', fillOpacity: 0.18 });
	// Dados simulados para estados
	const data = {
		playing: { title: `Top Hit em ${stateName}`, artist: `${stateName} Artist`, art: "https://picsum.photos/seed/"+encodeURIComponent(stateName)+"/300/300", src: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" },
		radios: [ { name: `Rádio ${stateName}`, src: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3" } ],
		top: [ `Top 1 ${stateName}`, `Top 2 ${stateName}` ],
		emergent: [ `Emergente ${stateName}` ],
		cultural: [ `Cultural ${stateName}` ]
	};
	openSidePanel(stateName, data);
}

/* ========== SIDE PANEL UI ========== */
const panel = document.getElementById('side-panel');
const panelBody = document.getElementById('panel-body');
const panelTitle = document.getElementById('panel-title');
document.getElementById('btn-close-panel').addEventListener('click', ()=> { panel.style.display = 'none'; panel.setAttribute('aria-hidden','true'); });

function openSidePanel(countryName, data){
	panel.style.display = 'block';
	panel.setAttribute('aria-hidden','false');
	panelTitle.innerText = countryName;

	// build HTML
	const html = [];

	// Now playing
	html.push(`<div class="panel-card">
		<div style="display:flex;gap:12px;align-items:center;">
			<img src="${data.playing.art}" alt="${escapeHtml(data.playing.title)}" style="width:72px;height:72px;object-fit:cover;border-radius:8px">
			<div>
				<div style="font-weight:700">${escapeHtml(data.playing.title)}</div>
				<div class="muted">${escapeHtml(data.playing.artist)}</div>
				<div style="margin-top:6px;">
					<button class="btn btn-sm btn-danger" id="panel-play-btn"><i class="fa fa-play"></i> Tocar</button>
					<button class="btn btn-sm btn-outline-light" id="panel-lyrics-btn">Letra</button>
				</div>
			</div>
		</div>
	</div>`);

	// Radios
	html.push(`<div class="panel-card">
		<div style="display:flex;justify-content:space-between;align-items:center;">
			<div style="font-weight:700">Rádios ao vivo</div>
			<div class="small-muted">Ao vivo (simulado)</div>
		</div>
		<div style="margin-top:8px;">${data.radios.map((r,idx)=>`
			<div class="mb-2">
				<div style="display:flex;align-items:center;gap:8px;">
					<button class="btn btn-sm btn-circle btn-outline-light btn-radio-play" data-src="${r.src}" title="Play radio"><i class="fa fa-play"></i></button>
					<div>
						<div style="font-weight:600">${escapeHtml(r.name)}</div>
						<div class="small-muted">Clique para tocar</div>
					</div>
				</div>
			</div>`).join('')}</div>
	</div>`);

	// Top / playlists
	html.push(`<div class="panel-card">
		<div style="font-weight:700">Em alta</div>
		<ul style="padding-left:12px;margin-top:8px">${data.top.map(t=>`<li class="small-muted">• ${escapeHtml(t)}</li>`).join('')}</ul>
	</div>`);

	// Emergent
	html.push(`<div class="panel-card">
		<div style="display:flex;justify-content:space-between;align-items:center;"><div style="font-weight:700">Artistas emergentes</div><div class="small-muted">Descubra</div></div>
		<ul style="margin-top:8px">${data.emergent.map(e=>`<li class="clickable" data-artist="${escapeAttr(e)}">${escapeHtml(e)}</li>`).join('')}</ul>
	</div>`);

	// Cultural playlist
	html.push(`<div class="panel-card">
		<div style="font-weight:700">Playlist cultural</div>
		<ul style="margin-top:8px">${data.cultural.map(c=>`<li class="small-muted">• ${escapeHtml(c)}</li>`).join('')}</ul>
	</div>`);

	panelBody.innerHTML = html.join('');

	// attach listeners: play buttons
	document.querySelectorAll('.btn-radio-play').forEach(btn => {
		btn.addEventListener('click', (ev)=>{
			const src = btn.dataset.src;
			playInFooter({ title: 'Rádio: ' + (btn.nextElementSibling ? btn.nextElementSibling.innerText : 'Estação'), artist: '', art: 'https://picsum.photos/seed/radio/80/80', src });
		});
	});

	// panel play main track
	const panelPlay = document.getElementById('panel-play-btn');
	if(panelPlay){
		panelPlay.addEventListener('click', ()=> playInFooter(data.playing));
	}

	// artist click (simulate show artist)
	panelBody.querySelectorAll('li.clickable').forEach(li => {
		li.addEventListener('click', ()=> {
			const artist = li.dataset.artist;
			alert('Abrir página do artista (simulação): ' + artist);
		});
	});
}

/* ========== FOOTER PLAYER (simple) ========== */
const audio = new Audio();
let playingTrack = null;
function playInFooter(track){
	if(!track || !track.src) return;
	playingTrack = track;
	audio.src = track.src;
	audio.crossOrigin = "anonymous";
	audio.play().catch(()=>{ /* play may be blocked until user gesture */ });
	document.getElementById('player-art').src = track.art || 'https://picsum.photos/seed/p/60/60';
	document.getElementById('player-title').innerText = track.title || '—';
	document.getElementById('player-artist').innerText = track.artist || '';
}

/* update progress and durations optional (not shown) */

/* ========== SEARCH FUNCTIONALITY ========== */
document.getElementById('search-btn').addEventListener('click', doSearch);
document.getElementById('search-input').addEventListener('keyup', (e)=> { if(e.key === 'Enter') doSearch(); });
document.getElementById('country-search').addEventListener('keyup', (e)=> { if(e.key==='Enter') doSearch(); });

function doSearch(){
	const q = (document.getElementById('search-input').value || document.getElementById('country-search').value || '').trim();
	if(!q) return;
	// find feature by ADMIN or NAME
	let found = null;
	geojsonLayer.eachLayer(layer => {
		const props = layer.feature.properties;
		const name = (props.ADMIN || props.NAME || '').toLowerCase();
		if(name === q.toLowerCase() || name.includes(q.toLowerCase())) {
			found = layer;
		}
	});
	if(found){
		map.fitBounds(found.getBounds(), { maxZoom:5, padding: [40,40] });
		found.fire('click');
	} else {
		alert('País não encontrado (tente grafias em inglês ou nome oficial). Ex.: "Brazil" ou "United States of America".');
	}
}

/* ========== UTILITIES ========== */
function escapeHtml(s){ return String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }
function escapeAttr(s){ return String(s||'').replace(/"/g,'&quot;'); }


// Inicialização correta: apenas rádios reais
loadRadioPlaces();

/* center world button */
document.getElementById('btn-center-world').addEventListener('click', ()=> map.setView([20,0], 2));

/* close panel when clicking outside (small UX) */
map.on('click', ()=>{ /* keep panel open intentionally */ });