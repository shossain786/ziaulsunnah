document.addEventListener('DOMContentLoaded', function () {
    let faqData = []; // To store FAQ data after fetching
    const faqContainer = document.getElementById('accordionExample');
    const categoryDropdown = document.getElementById('categoryDropdown');
    const searchBox = document.getElementById('searchBox');

    // Fetch FAQ data from PHP endpoint
    fetch('get_sawal.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            faqData = data.categories;
            populateCategoryDropdown(faqData);
            displayFAQs(faqData); // Initial display
        })
        .catch(error => {
            console.error('Error fetching the data:', error);
            faqContainer.innerHTML = '<p>Error loading FAQs.</p>';
        });

    // Populate category dropdown
    function populateCategoryDropdown(categories) {
        categories.forEach(category => {
            const option = document.createElement('option');
            option.value = category.name;
            option.textContent = category.name;
            categoryDropdown.appendChild(option);
        });
    }

    // Display FAQs based on selected category and search text
    function displayFAQs(categories, selectedCategory = '', searchText = '') {
        faqContainer.innerHTML = ''; // Clear existing content
console.log(categories)
let accordionHTML = '';
categories.forEach((category, categoryIndex) => {
     if (selectedCategory && category.name !== selectedCategory) {
                return;
            }
    let categoryHTML = `
      
            <div class="category-text">${category.name}</div>`;
    
    category.questions.forEach((item, questionIndex) => {
          if (searchText && !item.question.toLowerCase().includes(searchText.toLowerCase())) {
                    return;
                }
        categoryHTML += `
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading${categoryIndex}-${questionIndex}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${categoryIndex}-${questionIndex}" aria-expanded="false" aria-controls="collapse${categoryIndex}-${questionIndex}">${item.question}</button>
            </h2>
            <div id="collapse${categoryIndex}-${questionIndex}" class="accordion-collapse collapse" aria-labelledby="heading${categoryIndex}-${questionIndex}" data-bs-parent="#accordionExample">
                <div class="accordion-body">${item.answer}</div>
            </div>`;
                categoryHTML += `</div>`; // Close accordion-item
    });


    accordionHTML += categoryHTML;
});

// Inject the HTML into the container
faqContainer.innerHTML = accordionHTML;
       /* categories.forEach(category => {
            if (selectedCategory && category.name !== selectedCategory) {
                return;
            }

            const categoryDiv = document.createElement('div');
            categoryDiv.className = 'category';

            const categoryHeader = document.createElement('h3');
            categoryHeader.textContent = category.name;
            categoryDiv.appendChild(categoryHeader);

            category.questions.forEach(item => {
                if (searchText && !item.question.toLowerCase().includes(searchText.toLowerCase())) {
                    return;
                }

                const questionDiv = document.createElement('div');
                questionDiv.className = 'faq-item';

                const question = document.createElement('h4');
                question.textContent = item.question;
                question.addEventListener('click', function () {
                    answer.classList.toggle('hidden');
                });

                const answer = document.createElement('p');
                answer.textContent = item.answer;
                answer.classList.add('hidden');

                questionDiv.appendChild(question);
                questionDiv.appendChild(answer);
                categoryDiv.appendChild(questionDiv);
            });

            faqContainer.appendChild(categoryDiv);
        }); */
    }

    // Event listener for category dropdown change
    categoryDropdown.addEventListener('change', function () {
        const selectedCategory = categoryDropdown.value;
        const searchText = searchBox.value;
        displayFAQs(faqData, selectedCategory, searchText);
    });

    // Event listener for search box input
    searchBox.addEventListener('input', function () {
        const selectedCategory = categoryDropdown.value;
        const searchText = searchBox.value;
        displayFAQs(faqData, selectedCategory, searchText);
    });
});
