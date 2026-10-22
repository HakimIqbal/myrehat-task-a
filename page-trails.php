<?php
/* Template Name: Trails Test Page */
get_header();
?>
<!-- A3: Sticky contact bar for WhatsApp and LINE with bold text -->
<div class="trails-sticky-contact">
  <div class="contact-buttons-container">
    <a href="https://wa.me/" class="btn-contact btn-whatsapp" target="_blank" rel="noopener noreferrer">
      <strong>WhatsApp</strong>
    </a>
    <a href="https://line.me/" class="btn-contact btn-line" target="_blank" rel="noopener noreferrer">
      <strong>LINE</strong>
    </a>
  </div>
</div>

<header class="site-header-trails">
  <!-- A5: Exact Title Requirement -->
  <h1>Tropic Hiking Trails</h1>
  <p>Find your next trail with MyRehat</p>
  <input id="main-search" type="text" placeholder="Search homepage...">
</header>

<div class="trails-promo">
  <strong>Limited offer:</strong> 20% off all guided hikes this month.
</div>

<main class="trails-main">
  <div class="trails-search-row">
    <input id="search-box" type="text" placeholder="Search trails...">
    <select id="category">
      <option value="all">All categories</option>
      <option value="mountain">Mountain</option>
      <option value="beach">Beach</option>
      <option value="forest">Forest</option>
    </select>
  </div>
  <p id="trails-no-results" hidden>No trails found.</p>

  <div class="trails-cards">
    <article class="trail-card" data-category="mountain">
      <h3>Mount Rinjani Sunrise</h3>
      <p>2-day guided summit trek, Lombok.</p>
      <span class="price">RM 350 / pax</span>
    </article>
    <article class="trail-card" data-category="beach">
      <h3>Pulau Perhentian Coastal Walk</h3>
      <p>Easy coastal trail, Terengganu.</p>
      <span class="price">RM 120 / pax</span>
    </article>
    <article class="trail-card" data-category="forest">
      <h3>Taman Negara Canopy Trail</h3>
      <p>Rainforest walk, Pahang.</p>
      <span class="price">RM 180 / pax</span>
    </article>
    <article class="trail-card" data-category="mountain">
      <h3>Mount Kinabalu Base Trek</h3>
      <p>Highland trek, Sabah.</p>
      <span class="price">RM 420 / pax</span>
    </article>
    <article class="trail-card" data-category="beach">
      <h3>Langkawi Sunset Ridge</h3>
      <p>Evening ridge walk, Kedah.</p>
      <span class="price">RM 95 / pax</span>
    </article>
    <article class="trail-card" data-category="forest">
      <h3>Belum Mossy Forest</h3>
      <p>Misty forest trail, Perak.</p>
      <span class="price">RM 150 / pax</span>
    </article>
  </div>

  <section class="trails-booking">
    <h2><?php echo esc_html( myrehat_test_booking_title() ); ?></h2>
    <form id="booking-form" method="post">
      <!-- Nonce & Form Identifier for Backend Security (B2 Sync) -->
      <input type="hidden" name="trails_booking" value="1">
      <?php wp_nonce_field( 'trails_booking_action', 'trails_booking_nonce' ); ?>

      <label>Name <input type="text" name="name" required></label>
      <label>Date <input type="date" name="date" required></label>

      <!-- A11: Duration Radio Options (Daily vs Monthly) -->
      <fieldset class="booking-duration-group">
        <legend>Booking Duration</legend>
        <label class="radio-label">
          <input type="radio" name="duration" value="daily" checked>
          <span>Daily (RM 350)</span>
        </label>
        <label class="radio-label">
          <input type="radio" name="duration" value="monthly">
          <span>Monthly (RM 8.400)</span>
        </label>
      </fieldset>

      <!-- A6: Digital Nomad Requirement -->
      <div class="form-field">
        <label for="digital-nomad">Are you a Digital Nomad? <span class="required">*</span></label>
        <select id="digital-nomad" name="digital_nomad" required>
          <option value="" disabled selected>Please select...</option>
          <option value="yes">Yes</option>
          <option value="no">No</option>
        </select>
      </div>

      <!-- A9: Host Terms Checkbox Agreement -->
      <div class="form-field checkbox-field">
        <label for="host-terms">
          <input type="checkbox" id="host-terms" name="host_terms" required>
          <span>I agree to the Host Terms <span class="required">*</span></span>
        </label>
      </div>

      <p id="trails-total">Total: RM 350</p>
      <button type="submit">Request booking</button>
    </form>
    <div id="trails-confirmation" hidden></div>
  </section>
</main>

<footer class="trails-footer">
  <!-- A4: Cleaned navigation (exactly 4 links) -->
  <nav class="trails-footer-nav" aria-label="Footer Navigation">
    <a href="#">FAQ</a>
    <a href="#">Contact Us</a>
    <a href="#">PDPA</a>
    <a href="#">Privacy Policy</a>
  </nav>

  <!-- A8: Social Media Links Section -->
  <div class="trails-social-links" aria-label="Social Media">
    <span class="social-title">Follow Us:</span>
    <a href="https://facebook.com/" target="_blank" rel="noopener noreferrer" aria-label="Facebook">Facebook</a>
    <a href="https://linkedin.com/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">LinkedIn</a>
    <a href="https://instagram.com/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">Instagram</a>
    <a href="https://tiktok.com/" target="_blank" rel="noopener noreferrer" aria-label="TikTok">TikTok</a>
    <a href="https://youtube.com/" target="_blank" rel="noopener noreferrer" aria-label="YouTube">YouTube</a>
  </div>

  <p>&copy; 2026 MyRehat</p>
</footer>
<?php get_footer(); ?>
