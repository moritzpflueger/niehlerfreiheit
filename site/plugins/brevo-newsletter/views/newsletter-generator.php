<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Newsletter Generator - Niehler Freiheit</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      background: #efefef;
      color: #16171a;
      line-height: 1.5;
      padding: 2rem;
    }
    
    .container {
      max-width: 1200px;
      margin: 0 auto;
    }
    
    .header {
      background: white;
      border-radius: 6px;
      padding: 2rem;
      margin-bottom: 2rem;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    
    .header h1 {
      font-size: 1.5rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }
    
    .header p {
      color: #777;
      font-size: 0.875rem;
    }
    
    .content {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 2rem;
    }
    
    .card {
      background: white;
      border-radius: 6px;
      padding: 2rem;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    
    .card-title {
      font-size: 1.125rem;
      font-weight: 600;
      margin-bottom: 1.5rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid #efefef;
    }
    
    .form-group {
      margin-bottom: 1.5rem;
    }
    
    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
    }
    
    label {
      display: block;
      font-size: 0.875rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: #16171a;
    }
    
    select, textarea, input {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #ccc;
      border-radius: 3px;
      font-family: inherit;
      font-size: 0.875rem;
      background: white;
      transition: border-color 0.2s;
    }
    
    select:focus, textarea:focus, input:focus {
      outline: none;
      border-color: #4271ae;
    }
    
    textarea {
      resize: vertical;
      min-height: 100px;
    }
    
    .help-text {
      font-size: 0.75rem;
      color: #777;
      margin-top: 0.25rem;
    }
    
    .events-list {
      list-style: none;
      margin: 1rem 0;
    }
    
    .event-item {
      padding: 0.75rem;
      border-left: 3px solid #4271ae;
      background: #f7f7f7;
      margin-bottom: 0.5rem;
      border-radius: 3px;
    }
    
    .event-title {
      font-weight: 600;
      font-size: 0.875rem;
      margin-bottom: 0.25rem;
    }
    
    .event-meta {
      font-size: 0.75rem;
      color: #777;
    }
    
    .empty-state {
      text-align: center;
      padding: 2rem;
      color: #999;
      font-size: 0.875rem;
    }
    
    .button-group {
      display: flex;
      gap: 1rem;
      margin-top: 2rem;
    }
    
    .btn {
      flex: 1;
      padding: 0.875rem 1.5rem;
      border: none;
      border-radius: 3px;
      font-family: inherit;
      font-size: 0.875rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
      text-decoration: none;
      display: inline-block;
      text-align: center;
    }
    
    .btn-primary {
      background: #4271ae;
      color: white;
    }
    
    .btn-primary:hover {
      background: #2c5282;
    }
    
    .btn-success {
      background: #10b981;
      color: white;
    }
    
    .btn-success:hover {
      background: #059669;
    }
    
    .btn:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }
    
    .info-box {
      background: #f0f7ff;
      border: 1px solid #bfdbfe;
      border-radius: 3px;
      padding: 1rem;
      font-size: 0.875rem;
      line-height: 1.6;
      color: #1e3a8a;
    }
    
    .info-box h3 {
      font-size: 0.875rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }
    
    .info-box ul {
      margin: 0.5rem 0 0 1.25rem;
    }
    
    .info-box li {
      margin-bottom: 0.25rem;
    }
    
    .message {
      padding: 1rem;
      border-radius: 3px;
      margin-bottom: 1rem;
      font-size: 0.875rem;
    }
    
    .message.success {
      background: #d1fae5;
      border: 1px solid #6ee7b7;
      color: #065f46;
    }
    
    .message.error {
      background: #fee2e2;
      border: 1px solid #fca5a5;
      color: #991b1b;
    }
    
    .loading {
      color: #777;
      font-style: italic;
    }
    
    @media (max-width: 768px) {
      .content {
        grid-template-columns: 1fr;
      }
      
      .form-row {
        grid-template-columns: 1fr;
      }
      
      .button-group {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>📧 Newsletter Generator</h1>
      <p>Erstelle einen Newsletter-Entwurf in Brevo oder sende direkt</p>
    </div>
    
    <div id="message"></div>
    
    <div class="content">
      <div class="card">
        <h2 class="card-title">Newsletter Inhalt</h2>
        
        <form id="newsletterForm">
          <div class="form-group">
            <div class="form-row">
              <div>
                <label for="month">Monat</label>
                <select id="month" name="month" required>
                  <option value="">-- Monat wählen --</option>
                  <option value="01">Januar</option>
                  <option value="02">Februar</option>
                  <option value="03">März</option>
                  <option value="04">April</option>
                  <option value="05">Mai</option>
                  <option value="06">Juni</option>
                  <option value="07">Juli</option>
                  <option value="08">August</option>
                  <option value="09">September</option>
                  <option value="10">Oktober</option>
                  <option value="11">November</option>
                  <option value="12">Dezember</option>
                </select>
              </div>
              <div>
                <label for="year">Jahr</label>
                <select id="year" name="year" required>
                  <option value="">-- Jahr wählen --</option>
                  <?php
                  $currentYear = date('Y');
                  for ($y = $currentYear; $y <= $currentYear + 10; $y++) {
                    echo "<option value=\"{$y}\">{$y}</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <p class="help-text">Wähle den Monat und das Jahr für die Newsletter-Events</p>
          </div>
          
          <div class="form-group">
            <label for="welcomeTextDe">Begrüßungstext (Deutsch)</label>
            <textarea id="welcomeTextDe" name="welcomeTextDe" required placeholder="Hallo liebe Freund:innen,

hier sind die kommenden Veranstaltungen..."></textarea>
            <p class="help-text">Dieser Text erscheint am Anfang des Newsletters</p>
          </div>
          
          <div class="form-group">
            <label for="welcomeTextEn">Begrüßungstext (English - wird kursiv dargestellt)</label>
            <textarea id="welcomeTextEn" name="welcomeTextEn" required placeholder="Hello dear friends,

here are the upcoming events..."></textarea>
            <p class="help-text">Englischer Text wird direkt unter dem deutschen Text in Kursiv angezeigt</p>
          </div>
          
          <div class="form-group">
            <label for="imageFile">Bild des Monats hochladen</label>
            <input type="file" id="imageFile" name="imageFile" accept="image/*">
            <input type="hidden" id="imageUrl" name="imageUrl">
            <p class="help-text">Optional - Wähle ein Bild von deinem Computer (JPG, PNG, GIF, WebP)</p>
            <div id="uploadStatus" style="margin-top: 10px; display: none;"></div>
          </div>
          
          <div class="form-group">
            <label for="imageCredits">Bildnachweis / Credits (optional)</label>
            <textarea id="imageCredits" name="imageCredits" rows="2" placeholder="Foto: Max Mustermann
© 2025"></textarea>
            <p class="help-text">Optional - Wird unter dem Bild angezeigt (Zeilenumbrüche möglich)</p>
          </div>
          
          <div class="button-group">
            <button type="button" id="createDraftBtn" class="btn btn-primary">
              ✏️ Draft in Brevo erstellen
            </button>
            <button type="button" id="sendNowBtn" class="btn btn-success">
              🚀 Sofort senden
            </button>
          </div>
        </form>
      </div>
      
      <div>
        <div class="card">
          <h2 class="card-title">Events in diesem Monat</h2>
          <div id="eventsPreview">
            <p class="empty-state">Wähle einen Monat, um Events anzuzeigen</p>
          </div>
        </div>
        
        <div class="card" style="margin-top: 2rem;">
          <div class="info-box">
            <h3>ℹ️ So funktioniert's:</h3>
            <ol>
              <li>Monat und Jahr wählen</li>
              <li>Begrüßungstext (Deutsch + Englisch) eingeben</li>
              <li>Optional: Bild hochladen oder URL eingeben</li>
              <li>"Draft erstellen" klicken</li>
              <li>In Brevo Vorschau prüfen und versenden</li>
            </ol>
            <p style="margin-top: 10px; font-size: 0.85em; color: #666;">
              <strong>Tipp:</strong> Hochgeladene Bilder werden in <code>/assets/pictures-of-the-month/</code> gespeichert und sind dauerhaft für alle Empfänger sichtbar.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    const monthSelect = document.getElementById('month');
    const yearSelect = document.getElementById('year');
    const eventsPreview = document.getElementById('eventsPreview');
    const createDraftBtn = document.getElementById('createDraftBtn');
    const sendNowBtn = document.getElementById('sendNowBtn');
    const messageDiv = document.getElementById('message');
    const imageFileInput = document.getElementById('imageFile');
    const imageUrlInput = document.getElementById('imageUrl');
    const uploadStatus = document.getElementById('uploadStatus');
    
    // Set default to next month
    const nextMonth = new Date();
    nextMonth.setMonth(nextMonth.getMonth() + 1);
    monthSelect.value = String(nextMonth.getMonth() + 1).padStart(2, '0');
    yearSelect.value = nextMonth.getFullYear();
    
    // Load events when month/year changes
    monthSelect.addEventListener('change', loadEvents);
    yearSelect.addEventListener('change', loadEvents);
    
    // Handle file upload
    imageFileInput.addEventListener('change', async (e) => {
      const file = e.target.files[0];
      if (!file) return;
      
      // Show uploading status
      uploadStatus.style.display = 'block';
      uploadStatus.innerHTML = '<span style="color: #4271ae;">⏳ Wird hochgeladen...</span>';
      
      // Create form data
      const formData = new FormData();
      formData.append('image', file);
      
      try {
        const response = await fetch('/brevo-newsletter/upload-image', {
          method: 'POST',
          body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
          imageUrlInput.value = data.url;
          uploadStatus.innerHTML = '<span style="color: #10b981;">✅ Bild erfolgreich hochgeladen!</span>';
          setTimeout(() => {
            uploadStatus.style.display = 'none';
          }, 3000);
        } else {
          uploadStatus.innerHTML = '<span style="color: #ef4444;">❌ ' + data.message + '</span>';
        }
      } catch (error) {
        console.error('Upload error:', error);
        uploadStatus.innerHTML = '<span style="color: #ef4444;">❌ Upload fehlgeschlagen</span>';
      }
    });
    
    // Load events on page load
    loadEvents();
    
    async function loadEvents() {
      const month = monthSelect.value;
      const year = yearSelect.value;
      
      if (!month || !year) {
        eventsPreview.innerHTML = '<p class="empty-state">Wähle einen Monat, um Events anzuzeigen</p>';
        return;
      }
      
      eventsPreview.innerHTML = '<p class="loading">Events werden geladen...</p>';
      
      try {
        const response = await fetch(`/brevo-newsletter/events/${year}/${month}`);
        const data = await response.json();
        
        if (data.success && data.events.length > 0) {
          const eventsList = data.events.map(event => `
            <li class="event-item">
              <div class="event-title">
                ${event.title}
                ${event.isRecurring ? '<span style="background: #4271ae; color: white; font-size: 11px; padding: 2px 6px; border-radius: 3px; margin-left: 8px;">wiederkehrend</span>' : ''}
              </div>
              <div class="event-meta">${event.date} - ${event.category}</div>
            </li>
          `).join('');
          
          eventsPreview.innerHTML = `
            <ul class="events-list">
              ${eventsList}
            </ul>
          `;
        } else {
          eventsPreview.innerHTML = '<p class="empty-state">Keine Events für diesen Monat gefunden</p>';
        }
      } catch (error) {
        console.error('Error loading events:', error);
        eventsPreview.innerHTML = '<p class="empty-state error">Fehler beim Laden der Events</p>';
      }
    }
    
    function showMessage(text, type = 'success') {
      messageDiv.innerHTML = `<div class="message ${type}">${text}</div>`;
      setTimeout(() => {
        messageDiv.innerHTML = '';
      }, 5000);
    }
    
    function getFormData() {
      return {
        monthYear: `${yearSelect.value}-${monthSelect.value}`,
        welcomeTextDe: document.getElementById('welcomeTextDe').value,
        welcomeTextEn: document.getElementById('welcomeTextEn').value,
        imageUrl: document.getElementById('imageUrl').value,
        imageCredits: document.getElementById('imageCredits').value
      };
    }
    
    createDraftBtn.addEventListener('click', async () => {
      if (!monthSelect.value || !yearSelect.value || !document.getElementById('welcomeTextDe').value || !document.getElementById('welcomeTextEn').value) {
        showMessage('Bitte fülle alle erforderlichen Felder aus', 'error');
        return;
      }
      
      createDraftBtn.disabled = true;
      createDraftBtn.textContent = '⏳ Erstelle Draft...';
      
      try {
        const response = await fetch('/brevo-newsletter/create-draft-form', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(getFormData())
        });
        
        const data = await response.json();
        
        if (data.success) {
          showMessage('✅ Draft erfolgreich erstellt! Weiterleitung zu Brevo...');
          setTimeout(() => {
            window.open(data.data.campaignUrl, '_blank');
          }, 1000);
        } else {
          showMessage('❌ Fehler: ' + data.message, 'error');
        }
      } catch (error) {
        console.error('Error:', error);
        showMessage('❌ Fehler beim Erstellen des Drafts', 'error');
      } finally {
        createDraftBtn.disabled = false;
        createDraftBtn.textContent = '✏️ Draft in Brevo erstellen';
      }
    });
    
    sendNowBtn.addEventListener('click', async () => {
      if (!monthSelect.value || !yearSelect.value || !document.getElementById('welcomeTextDe').value || !document.getElementById('welcomeTextEn').value) {
        showMessage('Bitte fülle alle erforderlichen Felder aus', 'error');
        return;
      }
      
      if (!confirm('⚠️ Der Newsletter wird SOFORT an alle Abonnenten gesendet! Fortfahren?')) {
        return;
      }
      
      sendNowBtn.disabled = true;
      sendNowBtn.textContent = '⏳ Sende...';
      
      try {
        const response = await fetch('/brevo-newsletter/send-now-form', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(getFormData())
        });
        
        const data = await response.json();
        
        if (data.success) {
          showMessage('✅ Newsletter erfolgreich gesendet!');
        } else {
          showMessage('❌ Fehler: ' + data.message, 'error');
        }
      } catch (error) {
        console.error('Error:', error);
        showMessage('❌ Fehler beim Senden des Newsletters', 'error');
      } finally {
        sendNowBtn.disabled = false;
        sendNowBtn.textContent = '🚀 Sofort senden';
      }
    });
  </script>
</body>
</html>

