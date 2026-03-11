document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-8px)';
            card.style.boxShadow = '0 8px 20px rgba(0,0,0,0.2)';
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
            card.style.boxShadow = '0 4px 8px rgba(0,0,0,0.1)';
        });
        
        card.addEventListener('click', (e) => {
            const ripple = document.createElement('span');
            ripple.className = 'ripple-effect';
            card.appendChild(ripple);
            
            const rect = card.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = (e.clientX - rect.left - size/2) + 'px';
            ripple.style.top = (e.clientY - rect.top - size/2) + 'px';
            
            setTimeout(() => ripple.remove(), 600);
        });
    });

    const currentPage = window.location.pathname.split('/').pop() || 'Landingpage.html';
    document.querySelectorAll('.sidebar a').forEach(link => {
        if (link.getAttribute('href') === currentPage) {
            link.classList.add('active');
        }
        
        if (link.textContent.trim() === 'Logout') {
            link.addEventListener('click', (e) => {
                if (!confirm('Apakah Anda yakin ingin logout?')) {
                    e.preventDefault();
                }
            });
        }
    });

    const hours = new Date().getHours();
    const greeting = hours < 12 ? 'Selamat pagi' : hours < 18 ? 'Selamat siang' : 'Selamat malam';
    
    if (!document.querySelector('.greeting')) {
        const greetingEl = document.createElement('div');
        greetingEl.className = 'greeting';
        greetingEl.textContent = `${greeting}, pengguna!`;
        document.querySelector('.card-container').before(greetingEl);
    }

    const style = document.createElement('style');
    style.textContent = `
        .card { position: relative; overflow: hidden; transition: all 0.3s ease; }
        .ripple-effect { position: absolute; border-radius: 50%; background: rgba(255,255,255,0.7); transform: scale(0); animation: ripple 0.6s ease-out; pointer-events: none; }
        @keyframes ripple { to { transform: scale(4); opacity: 0; } }
        .greeting { text-align: center; font-size: 1.5rem; margin-bottom: 2rem; animation: fadeIn 0.5s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .sidebar a.active { background-color: #82E4DF; color: white; font-weight: bold; }
    `;
    document.head.appendChild(style);
});