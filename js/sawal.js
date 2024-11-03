document.addEventListener('DOMContentLoaded', function() {
    fetch('data/faq.json')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const faqContainer = document.getElementById('faq-container');
            if (data.categories.length === 0) {
                faqContainer.innerHTML = '<p>No FAQs available.</p>';
                return;
            }

            data.categories.forEach(category => {
                const categoryDiv = document.createElement('div');
                categoryDiv.className = 'category';

                const categoryHeader = document.createElement('h3');
                categoryHeader.textContent = category.name;
                categoryDiv.appendChild(categoryHeader);

                category.questions.forEach(item => {
                    const questionDiv = document.createElement('div');
                    questionDiv.className = 'faq-item';

                    const question = document.createElement('h4');
                    question.textContent = item.question;
                    question.addEventListener('click', function() {
                        answer.classList.toggle('hidden'); // Toggle visibility of answer
                    });

                    const answer = document.createElement('p');
                    answer.textContent = item.answer;
                    answer.classList.add('hidden'); // Initially hidden

                    questionDiv.appendChild(question);
                    questionDiv.appendChild(answer);
                    categoryDiv.appendChild(questionDiv);
                });

                faqContainer.appendChild(categoryDiv);
            });
        })
        .catch(error => {
            console.error('Error fetching the JSON data:', error);
            document.getElementById('faq-container').innerHTML = '<p>Error loading FAQs.</p>';
        });
});
