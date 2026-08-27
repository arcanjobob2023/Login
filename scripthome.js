

document.addEventListener('DOMContentLoaded', async () => {
    const clickStorageKey = 'trabalhojunho_click_counts';

    const getLocalClickCounts = () => {
        try {
            return JSON.parse(localStorage.getItem(clickStorageKey)) || {};
        } catch (error) {
            return {};
        }
    };

    const saveLocalClickCounts = (counts) => {
        localStorage.setItem(clickStorageKey, JSON.stringify(counts));
    };

    const incrementLocalClickCount = (pageName) => {
        const counts = getLocalClickCounts();
        counts[pageName] = (counts[pageName] || 0) + 1;
        saveLocalClickCounts(counts);
        return counts[pageName];
    };

    const updateClickCountDisplay = (counts) => {
        const setCount = (elementId, value) => {
            const element = document.getElementById(elementId);
            if (element) {
                element.textContent = value;
            }
        };

        setCount('indexPageClicks', counts['home.php'] || 0);
        setCount('applicationsPageClicks', counts['applications.php'] || 0);
        setCount('aboutPageClicks', counts['about.php'] || 0);

        if (window.location.pathname.includes('applications.php')) {
            setCount('currentPageClicks', counts['applications.php'] || 0);
        } else if (window.location.pathname.includes('about.php')) {
            setCount('currentPageClicks', counts['about.php'] || 0);
        } else {
            setCount('currentPageClicks', counts['home.php'] || 0);
        }
    };

  
    const trackPageView = async (pageName) => {
        try {
            const response = await fetch('api/track_clicks.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ page: pageName }),
            });
            const data = await response.json();
            if (!response.ok || !data.success) {
                throw new Error(data.message || 'Falha ao registrar visualização.');
            }

            return data.clicks;
        } catch (error) {
            const localClicks = incrementLocalClickCount(pageName);
            console.error('Network error tracking page view:', error);
            return localClicks;
        }
    };

    const getClickCounts = async () => {
        try {
            const response = await fetch('api/get_clicks.php');
            const data = await response.json();
            if (!response.ok || !data.success) {
                throw new Error(data.message || 'Falha ao carregar contadores.');
            }

            updateClickCountDisplay(data.clicks || {});
            return data.clicks || {};
        } catch (error) {
            const localCounts = getLocalClickCounts();
            updateClickCountDisplay(localCounts);
            console.error('Network error getting click counts:', error);
            return localCounts;
        }
    };

  
    const currentPage = window.location.pathname.split('/').pop() || 'home.php';
    await trackPageView(currentPage);
    await getClickCounts();
    
      setInterval(getClickCounts, 5000);


   
    const chatbotInput = document.getElementById('chatbotInput');
    const chatbotSend = document.getElementById('chatbotSend');
    const chatbotResponse = document.getElementById('chatbotResponse');

    const buildChatbotReply = (message) => {
        const normalizedMessage = message.toLowerCase();

        if (/^(oi|olá|ola|bom dia|boa tarde|boa noite)\b/.test(normalizedMessage)) {
            return 'Olá! Posso te ajudar com as páginas, a galeria e o contador de cliques do site.';
        }

        if (normalizedMessage.includes('página') || normalizedMessage.includes('paginas') || normalizedMessage.includes('site')) {
            return 'Este site tem as páginas Início, Aplicações e Sobre Nós. Em Aplicações você encontra o chatbot, a galeria de imagens e o contador de cliques.';
        }

        if (normalizedMessage.includes('aplicações') || normalizedMessage.includes('aplicacoes') || normalizedMessage.includes('aplicação') || normalizedMessage.includes('aplicacao')) {
            return 'Na página Aplicações você pode testar o chatbot, ver a galeria de imagens e acompanhar os cliques das páginas.';
        }

        if (normalizedMessage.includes('galeria') || normalizedMessage.includes('imagem') || normalizedMessage.includes('fotos')) {
            return 'A galeria busca as imagens da pasta img usando os arquivos 1.jpg até 10.jpg.';
        }

        if (normalizedMessage.includes('clima') || normalizedMessage.includes('tempo') || normalizedMessage.includes('previsão') || normalizedMessage.includes('previsao') || normalizedMessage.includes('propaganda') || normalizedMessage.includes('anúncio') || normalizedMessage.includes('anuncio') || normalizedMessage.includes('publicidade')) {
            return 'O espaço que antes mostrava a previsão do tempo agora é um espaço publicitário disponível para divulgação.';
        }

        if (normalizedMessage.includes('clique') || normalizedMessage.includes('visita') || normalizedMessage.includes('contador')) {
            return 'O contador mostra quantas vezes cada página foi visitada: Início, Aplicações e Sobre Nós.';
        }

        if (normalizedMessage.includes('sobre') || normalizedMessage.includes('equipe') || normalizedMessage.includes('integrante')) {
            return 'A página Sobre Nós traz os integrantes do grupo e uma breve descrição do projeto.';
        }

        if (normalizedMessage.includes('ajuda') || normalizedMessage.includes('o que você faz') || normalizedMessage.includes('o que faz')) {
            return 'Posso responder sobre as páginas do site, a galeria e o contador de cliques.';
        }

        return 'Posso responder sobre o site. Tente perguntar sobre as páginas, a galeria de imagens, o espaço publicitário ou o contador de cliques.';
    };

    if (chatbotSend) {
        chatbotSend.addEventListener('click', () => {
            const message = chatbotInput.value.trim();
            if (message) {
                chatbotResponse.innerHTML += `<p>Você: ${message}</p>`;
                chatbotResponse.innerHTML += `<p>Chatbot: ${buildChatbotReply(message)}</p>`;
                chatbotInput.value = '';
                chatbotResponse.scrollTop = chatbotResponse.scrollHeight; 
            }
        });
        chatbotInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                chatbotSend.click();
            }
        });
    }

    
    const galleryInner = document.getElementById('galleryInner');
    if (galleryInner) {
        const imageUrls = Array.from({ length: 10 }, (_, index) => `img/${index + 1}.jpg`);

        imageUrls.forEach((url, index) => {
            const carouselItem = document.createElement('div');
            carouselItem.classList.add('carousel-item');
            if (index === 0) {
                carouselItem.classList.add('active');
            }
            carouselItem.innerHTML = `<img src="${url}" class="d-block w-100" alt="Japanese Scene ${index + 1}">`;
            galleryInner.appendChild(carouselItem);
        });
    }

});