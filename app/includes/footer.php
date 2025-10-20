    <script src="/musictify/app/scripts/home.js"></script>
    <footer class="footer bg-dark text-white mt-5 p-3 text-center">
        MusicPlata &copy; 2025
    </footer>
</footer>
        <!-- Scripts do template -->
        <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
        <script>
        // Carrossel Recomendações
        new Swiper('#swiper-recomendacoes', {
            slidesPerView: 4,
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
            spaceBetween: 16,
            breakpoints: {
                1200: { slidesPerView: 4 },
                991: { slidesPerView: 3 },
                767: { slidesPerView: 2 },
                0: { slidesPerView: 1 }
            }
        });
        new Swiper('#swiper-amigos', {
            slidesPerView: 4,
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
            spaceBetween: 16,
            breakpoints: {
                1200: { slidesPerView: 4 },
                991: { slidesPerView: 3 },
                767: { slidesPerView: 2 },
                0: { slidesPerView: 1 }
            }
        });
        // Player funcional
        let tocando = false;
        const playBtn = document.getElementById('player-play');
        if (playBtn) {
            playBtn.onclick = function() {
                tocando = !tocando;
                this.innerHTML = tocando ? '<i class="fa fa-pause"></i>' : '<i class="fa fa-play"></i>';
            };
        }
        // Seleção de mood
        const moodBtns = document.querySelectorAll('.mood-btn');
        if (moodBtns.length > 0) {
            moodBtns.forEach(btn => {
                btn.onclick = function() {
                    moodBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    const iaMsg = document.getElementById('ia-msg');
                    if (iaMsg) iaMsg.innerText = 'Recomendações para o mood: ' + this.innerText;
                };
            });
        }
        // IA assistente
        const iaEnviar = document.getElementById('ia-enviar');
        if (iaEnviar) {
            iaEnviar.onclick = function() {
                const iaInput = document.getElementById('ia-input');
                const iaMsg = document.getElementById('ia-msg');
                if (iaMsg) iaMsg.innerText = 'Sugestão: Ouça músicas calmas!';
            };
        }
        </script>
</body>
</html>
