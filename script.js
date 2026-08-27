
    
        const animeImages = [
            'anime1.jpg',
            'anime2.jpg',
            'anime3.jpg',
            'anime4.jpg',
			'anime5.jpg',
            'anime6.jpg'
        ];

    
        function loadRandomAnimeImage() {
            const randomIndex = Math.floor(Math.random() * animeImages.length);
            document.getElementById('animeImage').src = animeImages[randomIndex];
        }

        
        window.onload = loadRandomAnimeImage;
