/**
 * Trails Page Interaction Script
 * Handles search filtering, category filtering, search input syncing,
 * dynamic pricing calculation, and booking form submission.
 */
document.addEventListener('DOMContentLoaded', function () {
  // Elements - Search & Filter
  var searchBox = document.getElementById('search-box');
  var mainSearch = document.getElementById('main-search');
  var categorySelect = document.getElementById('category');
  var cards = document.querySelectorAll('.trail-card');
  var emptyMsg = document.getElementById('trails-no-results');

  // Elements - Booking & Calculation
  var bookingForm = document.getElementById('booking-form');
  var trailsTotal = document.getElementById('trails-total');
  var trailsConfirmation = document.getElementById('trails-confirmation');

  /**
   * Filter cards based on combined text query and selected category
   */
  function filterTrails() {
    var query = (searchBox ? searchBox.value : '').trim().toLowerCase();
    var category = categorySelect ? categorySelect.value : 'all';
    var shownCount = 0;

    cards.forEach(function (card) {
      var cardText = card.textContent.toLowerCase();
      var cardCategory = card.getAttribute('data-category') || '';

      var matchesText = cardText.includes(query);
      var matchesCategory = (category === 'all') || (cardCategory === category);

      var isVisible = matchesText && matchesCategory;
      card.style.display = isVisible ? '' : 'none';

      if (isVisible) {
        shownCount++;
      }
    });

    if (emptyMsg) {
      emptyMsg.hidden = shownCount > 0;
    }
  }

  // --- A1 & A10: Search Filters and Input Synchronization ---
  if (searchBox) {
    searchBox.addEventListener('input', function () {
      if (mainSearch && mainSearch.value !== searchBox.value) {
        mainSearch.value = searchBox.value;
      }
      filterTrails();
    });
  }

  if (mainSearch) {
    mainSearch.addEventListener('input', function () {
      if (searchBox && searchBox.value !== mainSearch.value) {
        searchBox.value = mainSearch.value;
      }
      filterTrails();
    });
  }

  // --- A2: Category Dropdown Filter ---
  if (categorySelect) {
    categorySelect.addEventListener('change', filterTrails);
  }

  // --- A11: Realtime Daily vs Monthly Price Calculation ---
  function updatePriceCalculation() {
    var selectedDuration = document.querySelector('input[name="duration"]:checked');
    if (!selectedDuration || !trailsTotal) {
      return;
    }

    var baseRate = 350;
    if (selectedDuration.value === 'monthly') {
      // Monthly: 350 * 30 * 0.8 = RM 8.400
      trailsTotal.textContent = 'Total: RM 8.400';
    } else {
      // Daily: RM 350
      trailsTotal.textContent = 'Total: RM 350';
    }
  }

  var durationRadios = document.querySelectorAll('input[name="duration"]');
  durationRadios.forEach(function (radio) {
    radio.addEventListener('change', updatePriceCalculation);
  });

  // Calculate on initial load if a duration radio is already selected
  updatePriceCalculation();

  // --- A12: Booking Confirmation Message ---
  if (bookingForm) {
    bookingForm.addEventListener('submit', function (e) {
      e.preventDefault();

      var nameInput = bookingForm.querySelector('input[name="name"]');
      var durationInput = bookingForm.querySelector('input[name="duration"]:checked');

      var name = nameInput && nameInput.value ? nameInput.value.trim() : 'Guest';
      var duration = durationInput ? durationInput.value : 'daily';
      var durationLabel = duration === 'monthly' ? 'Monthly' : 'Daily';

      if (trailsConfirmation) {
        trailsConfirmation.innerHTML =
          '<strong>Booking Confirmed!</strong><br>' +
          'Thank you, ' + escapeHtml(name) + '. Your ' + durationLabel + ' booking request has been successfully submitted.';
        trailsConfirmation.hidden = false;
        trailsConfirmation.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }
    });
  }

  function escapeHtml(string) {
    var div = document.createElement('div');
    div.textContent = string;
    return div.innerHTML;
  }
});
