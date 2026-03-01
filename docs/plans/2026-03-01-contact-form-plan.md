# Contact Form Implementation Plan

> **For Claude:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task.

**Goal:** Add an inline contact form to both FR and EN marketing pages, replacing mailto links with a working AJAX form backed by PHP `mail()`.

**Architecture:** Static HTML form in each page, jQuery AJAX POST to `contact.php`, PHP validates/sanitizes and sends email via `mail()`. Honeypot field for spam. No database.

**Tech Stack:** HTML5, CSS3 (in `styles-new.css`), jQuery 3.4.1 (already loaded), PHP `mail()`

---

### Task 1: Create contact form CSS

**Files:**
- Modify: `public_html/styles-new.css` (append after line 365)

**Step 1: Add contact form styles to styles-new.css**

Append these styles at the end of the file:

```css
/* ========================
   CONTACT FORM SECTION
   ======================== */
.contact-section {
    padding: 100px 0;
    background: #fff;
}
.contact-inner {
    max-width: 600px;
    margin: 0 auto;
    text-align: center;
}
.contact-inner h2 {
    font-family: "Unna", serif;
    font-size: 39px;
    font-weight: 700;
    margin-bottom: 12px;
    color: #000;
}
.contact-inner .contact-subtitle {
    font-family: "Inter", sans-serif;
    font-size: 14px;
    font-style: italic;
    color: #555;
    margin-bottom: 40px;
}
.contact-form {
    text-align: left;
}
.form-group {
    margin-bottom: 20px;
}
.form-group label {
    display: block;
    font-family: "Inter", sans-serif;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #333;
    margin-bottom: 8px;
}
.form-group input,
.form-group textarea {
    width: 100%;
    padding: 14px 18px;
    font-family: "Inter", sans-serif;
    font-size: 14px;
    font-style: italic;
    color: #333;
    background: #f8f8f8;
    border: 1px solid #e8e8e8;
    border-radius: 8px;
    outline: none;
    transition: border-color 0.2s ease;
    box-sizing: border-box;
}
.form-group input:focus,
.form-group textarea:focus {
    border-color: #FFA163;
}
.form-group textarea {
    height: 140px;
    resize: vertical;
}
.form-group input::placeholder,
.form-group textarea::placeholder {
    color: #aaa;
    font-style: italic;
}
.hp-field {
    position: absolute;
    left: -9999px;
    opacity: 0;
    height: 0;
    width: 0;
    overflow: hidden;
}
.contact-submit {
    display: inline-block;
    width: 100%;
    padding: 16px;
    font-family: "Inter", sans-serif;
    font-size: 15px;
    font-weight: 600;
    color: #000;
    background: #FFA163;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.2s ease, transform 0.2s ease;
    margin-top: 10px;
}
.contact-submit:hover {
    background: #ff8c3a;
    transform: translateY(-2px);
}
.contact-submit:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}
.contact-message {
    margin-top: 20px;
    padding: 14px 18px;
    border-radius: 8px;
    font-family: "Inter", sans-serif;
    font-size: 13px;
    font-style: italic;
    display: none;
}
.contact-message.success {
    background: #f0faf0;
    color: #27ae60;
    border: 1px solid #d4edda;
}
.contact-message.error {
    background: #fff5f5;
    color: #c0392b;
    border: 1px solid #f5c6cb;
}
@media only screen and (max-width: 1023px) {
    .contact-section {
        padding: 70px 0;
    }
    .contact-inner h2 {
        font-size: 33px;
    }
}
@media only screen and (max-width: 767px) {
    .contact-section {
        padding: 50px 0;
    }
    .contact-inner h2 {
        font-size: 27px;
    }
    .contact-inner .contact-subtitle {
        font-size: 12px;
    }
    .form-group input,
    .form-group textarea {
        padding: 12px 14px;
        font-size: 13px;
    }
    .contact-submit {
        font-size: 13px;
        padding: 14px;
    }
}
```

**Step 2: Commit**

```bash
git add public_html/styles-new.css
git commit -m "feat: add contact form CSS styles"
```

---

### Task 2: Create PHP backend (contact.php)

**Files:**
- Create: `public_html/contact.php`

**Step 1: Create contact.php**

```php
<?php
header('Content-Type: application/json');

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Honeypot check
if (!empty($_POST['website'])) {
    echo json_encode(['success' => true, 'message' => 'Thank you!']);
    exit;
}

// Rate limiting via session
session_start();
$now = time();
if (isset($_SESSION['last_contact']) && ($now - $_SESSION['last_contact']) < 60) {
    http_response_code(429);
    $locale = isset($_POST['locale']) && $_POST['locale'] === 'fr' ? 'fr' : 'en';
    $msg = $locale === 'fr'
        ? 'Veuillez patienter une minute avant de renvoyer un message.'
        : 'Please wait one minute before sending another message.';
    echo json_encode(['success' => false, 'message' => $msg]);
    exit;
}

// Validate inputs
$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$phone   = trim($_POST['phone'] ?? '');
$message = trim($_POST['message'] ?? '');
$locale  = ($_POST['locale'] ?? 'en') === 'fr' ? 'fr' : 'en';

$errors = [];

if ($name === '' || strlen($name) > 100) {
    $errors[] = $locale === 'fr' ? 'Le nom est requis.' : 'Name is required.';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = $locale === 'fr' ? 'Adresse email invalide.' : 'Invalid email address.';
}
if ($message === '' || strlen($message) > 2000) {
    $errors[] = $locale === 'fr' ? 'Le message est requis.' : 'Message is required.';
}

if (!empty($errors)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

// Sanitize
$name    = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$email   = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$phone   = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

// Build email
$to      = 'imf-info@mail.com';
$subject = "[Immo-Enrichi] New Contact: $name";
$body    = "Name: $name\n";
$body   .= "Email: $email\n";
if ($phone !== '') {
    $body .= "Phone: $phone\n";
}
$body   .= "Locale: $locale\n\n";
$body   .= "Message:\n$message\n";

$headers  = "From: noreply@immobiliermatrixfrance.fr\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send
$sent = mail($to, $subject, $body, $headers);

if ($sent) {
    $_SESSION['last_contact'] = $now;
    $msg = $locale === 'fr'
        ? 'Merci ! Votre message a bien été envoyé.'
        : 'Thank you! Your message has been sent.';
    echo json_encode(['success' => true, 'message' => $msg]);
} else {
    http_response_code(500);
    $msg = $locale === 'fr'
        ? 'Une erreur est survenue. Veuillez réessayer.'
        : 'Something went wrong. Please try again.';
    echo json_encode(['success' => false, 'message' => $msg]);
}
```

**Step 2: Commit**

```bash
git add public_html/contact.php
git commit -m "feat: add contact form PHP backend"
```

---

### Task 3: Add contact form HTML to en.html

**Files:**
- Modify: `public_html/en.html`

**Step 1: Update nav Contact links (lines 46 and 81)**

Change the nav Contact `<a>` tags from:
```html
<a href="mailto:imf-info@mail.com?subject=Enquiry from website">Contact</a>
```
to:
```html
<a href="#contact">Contact</a>
```

Do this for both the desktop nav (line 46) and mobile nav (line 81).

**Step 2: Insert contact form HTML after FAQ section**

Insert the following HTML between the `<!-- END FAQs -->` comment (line 771) and the `<!-- ready to join -->` comment (line 773):

```html

    <!-- CONTACT FORM -->
    <div class="contact-section" id="contact">
        <div class="contact-inner wrapper">
            <h2>Get in Touch</h2>
            <p class="contact-subtitle">Have a question? We'd love to hear from you.</p>

            <form class="contact-form" id="contactForm" novalidate>
                <input type="hidden" name="locale" value="en">

                <div class="form-group">
                    <label for="contactName">Name *</label>
                    <input type="text" id="contactName" name="name" placeholder="Your full name" required maxlength="100">
                </div>

                <div class="form-group">
                    <label for="contactEmail">Email *</label>
                    <input type="email" id="contactEmail" name="email" placeholder="your@email.com" required>
                </div>

                <div class="form-group">
                    <label for="contactPhone">Phone</label>
                    <input type="tel" id="contactPhone" name="phone" placeholder="+33 6 00 00 00 00">
                </div>

                <div class="form-group">
                    <label for="contactMessage">Message *</label>
                    <textarea id="contactMessage" name="message" placeholder="How can we help you?" required maxlength="2000"></textarea>
                </div>

                <!-- Honeypot -->
                <div class="hp-field">
                    <input type="text" name="website" tabindex="-1" autocomplete="off">
                </div>

                <button type="submit" class="contact-submit">Send Message</button>
                <div class="contact-message" id="contactMsg"></div>
            </form>
        </div>
    </div>
    <!-- END CONTACT FORM -->

```

**Step 3: Add jQuery AJAX handler before closing `</body>` tag**

Insert the following `<script>` block just before the closing `</body>` tag (after the existing scripts like `main.js`):

```html
    <script>
    $(function() {
        $('#contactForm').on('submit', function(e) {
            e.preventDefault();
            var $form = $(this);
            var $btn = $form.find('.contact-submit');
            var $msg = $('#contactMsg');

            $btn.prop('disabled', true).text('Sending...');
            $msg.hide().removeClass('success error');

            $.ajax({
                url: '/contact.php',
                method: 'POST',
                data: $form.serialize(),
                dataType: 'json',
                success: function(res) {
                    $msg.addClass('success').text(res.message).fadeIn();
                    $form[0].reset();
                },
                error: function(xhr) {
                    var res = xhr.responseJSON || {};
                    var text = res.message || 'Something went wrong. Please try again.';
                    $msg.addClass('error').text(text).fadeIn();
                },
                complete: function() {
                    $btn.prop('disabled', false).text('Send Message');
                }
            });
        });
    });
    </script>
```

**Step 4: Update cache-busting version on styles-new.css link**

Update the `styles-new.css` link to use the new date:
```html
<link rel="stylesheet" href="styles-new.css?v=20260301">
```

**Step 5: Commit**

```bash
git add public_html/en.html
git commit -m "feat: add contact form to English marketing page"
```

---

### Task 4: Add contact form HTML to fr.html

**Files:**
- Modify: `public_html/fr.html`

**Step 1: Update nav Contact links (lines 46 and 81)**

Change from:
```html
<a href="mailto:imf-info@mail.com?subject=Demande depuis le site web">Contact</a>
```
to:
```html
<a href="#contact">Contact</a>
```

Do this for both the desktop nav (line 46) and mobile nav (line 81).

**Step 2: Insert contact form HTML after FAQ section**

Insert between `<!-- END FAQs -->` (line 771) and `<!-- ready to join -->` (line 773):

```html

    <!-- CONTACT FORM -->
    <div class="contact-section" id="contact">
        <div class="contact-inner wrapper">
            <h2>Contactez-nous</h2>
            <p class="contact-subtitle">Vous avez une question ? N'hésitez pas à nous écrire.</p>

            <form class="contact-form" id="contactForm" novalidate>
                <input type="hidden" name="locale" value="fr">

                <div class="form-group">
                    <label for="contactName">Nom *</label>
                    <input type="text" id="contactName" name="name" placeholder="Votre nom complet" required maxlength="100">
                </div>

                <div class="form-group">
                    <label for="contactEmail">Email *</label>
                    <input type="email" id="contactEmail" name="email" placeholder="votre@email.com" required>
                </div>

                <div class="form-group">
                    <label for="contactPhone">Téléphone</label>
                    <input type="tel" id="contactPhone" name="phone" placeholder="+33 6 00 00 00 00">
                </div>

                <div class="form-group">
                    <label for="contactMessage">Message *</label>
                    <textarea id="contactMessage" name="message" placeholder="Comment pouvons-nous vous aider ?" required maxlength="2000"></textarea>
                </div>

                <!-- Honeypot -->
                <div class="hp-field">
                    <input type="text" name="website" tabindex="-1" autocomplete="off">
                </div>

                <button type="submit" class="contact-submit">Envoyer le message</button>
                <div class="contact-message" id="contactMsg"></div>
            </form>
        </div>
    </div>
    <!-- END CONTACT FORM -->

```

**Step 3: Add jQuery AJAX handler before closing `</body>` tag**

Same as EN but with French button text:

```html
    <script>
    $(function() {
        $('#contactForm').on('submit', function(e) {
            e.preventDefault();
            var $form = $(this);
            var $btn = $form.find('.contact-submit');
            var $msg = $('#contactMsg');

            $btn.prop('disabled', true).text('Envoi en cours...');
            $msg.hide().removeClass('success error');

            $.ajax({
                url: '/contact.php',
                method: 'POST',
                data: $form.serialize(),
                dataType: 'json',
                success: function(res) {
                    $msg.addClass('success').text(res.message).fadeIn();
                    $form[0].reset();
                },
                error: function(xhr) {
                    var res = xhr.responseJSON || {};
                    var text = res.message || 'Une erreur est survenue. Veuillez réessayer.';
                    $msg.addClass('error').text(text).fadeIn();
                },
                complete: function() {
                    $btn.prop('disabled', false).text('Envoyer le message');
                }
            });
        });
    });
    </script>
```

**Step 4: Update cache-busting version on styles-new.css link**

```html
<link rel="stylesheet" href="styles-new.css?v=20260301">
```

**Step 5: Commit**

```bash
git add public_html/fr.html
git commit -m "feat: add contact form to French marketing page"
```

---

### Task 5: Final commit and verification

**Step 1: Verify all files are committed**

```bash
git status
```

Expected: clean working tree.

**Step 2: Visual check list**

Manually verify:
- [ ] Nav "Contact" links scroll to `#contact` on both pages
- [ ] Mobile nav "Contact" links work too
- [ ] Form displays correctly between FAQ and "Ready to Join"
- [ ] Form fields accept input
- [ ] Honeypot field is invisible
- [ ] Responsive layout stacks on mobile
- [ ] Footer mailto links still work (these stay as-is)

**Step 3: Test contact.php on server**

After deploying to cPanel, test with a `curl` POST:
```bash
curl -X POST https://immobiliermatrixfrance.fr/contact.php \
  -d "name=Test&email=test@test.com&message=Hello&locale=en"
```

Expected response: `{"success":true,"message":"Thank you! Your message has been sent."}`
