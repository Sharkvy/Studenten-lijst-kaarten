const cards = document.querySelectorAll('.card');

cards.forEach(card => {
  const name = card.querySelector('.card-name');
  const info = card.querySelectorAll('.card-info');
  const header = card.querySelector('.card-header');

  header.addEventListener('click', () => {
    // close all other cards
    cards.forEach(otherCard => {
      if (otherCard !== card) {
        const otherInfo = otherCard.querySelectorAll('.card-info');
        otherInfo.forEach(el => {
          el.style.display = 'none';
        });
        otherCard.querySelector('.card-header').classList.remove('active');
      }
    });

    // toggle the clicked card
    info.forEach(el => {
      el.style.display = el.style.display === 'none' ? 'block' : 'none';
    });
    header.classList.toggle('active');
  });
});

const searchInput = document.querySelector('.search');
searchInput.addEventListener('keyup', function(event) {
  const searchText = event.target.value.toLowerCase();

  cards.forEach(function(card) {
    const name = card.querySelector('.card-name').textContent.toLowerCase();

    if (name.includes(searchText)) {
      card.style.display = 'block';
    } else {
      card.style.display = 'none';
    }
  });
});

const sortButtons = document.querySelectorAll('.sort-button');
sortButtons.forEach(button => {
  button.addEventListener('click', () => {
    const value = button.dataset.value;
    const sortCards = (value) => {
      const sortedCards = Array.from(cards).sort((a, b) => {
        const aValue = a.dataset.lastname;
        const bValue = b.dataset.lastname;
        let result = 0;
        if (value === '1') {
          result = bValue.localeCompare(aValue);
        } else if (value === '2') {
          result = aValue.localeCompare(bValue);
        }
        return result;
      });
      sortedCards.forEach(card => card.parentNode.appendChild(card));
    };
    sortCards(value);

    // mark the selected sort button
    sortButtons.forEach(otherButton => {
      if (otherButton !== button) {
        otherButton.classList.remove('active');
      }
    });
    button.classList.add('active');
  });

  // add the active class to the "Sort Z-A" button by default
  if (button.dataset.value === '1') {
    button.classList.add('active');
  }
});

document.getElementById("export-pdf").addEventListener("click", function() {
  // create a new jsPDF instance
  var doc = new jsPDF();

  // loop through each card and add it to the PDF
  var cards = document.getElementsByClassName("card");
  for (var i = 0; i < cards.length; i++) {
    // get the card's HTML content
    var cardHTML = cards[i].outerHTML;

    // add the card's HTML content to the PDF
    doc.html(cardHTML);
    if (i < cards.length - 1) {
      doc.addPage();
    }
  }

  // save the PDF
  doc.save("cards.pdf");
});
