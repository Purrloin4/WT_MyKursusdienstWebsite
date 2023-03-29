const bookItems = document.getElementsByClassName('Book');
const infoItem = document.getElementById('info-text');

for (const book of bookItems) {
    book.addEventListener('click', updateReference);
}

function updateReference(event) {
    const isbn = event.target.dataset.isbn;
    const url = `https://openlibrary.org/isbn/${isbn}.json`;

    fetch(url)
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('not found');
            }
        })
        .then(result => {
            const publishDate = result.publish_date;
            const numberOfPages = result.number_of_pages;
            infoItem.innerHTML = `published on ${publishDate} (${numberOfPages} pages)`;
        })
        .catch(() => {
            infoItem.innerHTML = "No extra info found";
        });
}