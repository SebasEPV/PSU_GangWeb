document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item');
    const colaboracionItems = document.querySelectorAll('.colaboracion-item');

    faqItems.forEach(item => {
        item.querySelector('.faq-question').addEventListener('click', () => {
            const answer = item.querySelector('.faq-answer');
            if (answer.style.display === 'block') {
                answer.style.display = 'none';
            } else {
                answer.style.display = 'block';
            }
        });
    });

});


    colaboracionItems.forEach(item => {
        item.querySelector('.colaboracion-question').addEventListener('click', () => {
            const answer = item.querySelector('.colaboracion-answer');
            if (answer.style.display === 'block') {
                answer.style.display = 'none';
            } else {
                answer.style.display = 'block';
            }
        });
    });