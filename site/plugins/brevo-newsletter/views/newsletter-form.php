<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Newsletter Generator</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background-color: #f5f5f7;
      padding: 0;
      margin: 0;
    }
    .panel-header {
      background: #16171a;
      color: #fff;
      padding: 1.5rem 2rem;
      border-bottom: 1px solid #000;
    }
    .panel-header h1 {
      font-size: 1.5rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem;
    }
    .card {
      background: white;
      border-radius: 6px;
      padding: 2rem;
      margin-bottom: 1.5rem;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .form-group {
      margin-bottom: 1.5rem;
    }
    .form-group label {
      display: block;
      font-size: 0.875rem;
      font-weight: 600;
      color: #16171a;
      margin-bottom: 0.5rem;
    }
    .form-group input[type="month"],
    .form-group input[type="text"],
    .form-group textarea,
    .form-group select {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 0.9375rem;
      font-family: inherit;
    }
    .form-group textarea {
      min-height: 120px;
      resize: vertical;
    }
    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
      outline: none;
      border-color: #4271ae;
    }
    .file-input {
      display: flex;
      gap: 1rem;
      align-items: center;
    }
    .file-input input[type="text"] {
      flex: 1;
    }
    .file-input button {
      padding: 0.75rem 1.5rem;
      background: #f0f0f0;
      border: 1px solid #ddd;
      border-radius: 4px;
      cursor: pointer;
      font-size: 0.875rem;
      font-weight: 500;
    }
    .file-input button:hover {
      background: #e0e0e0;
    }
    .events-list {
      background: #f9f9f9;
      border: 1px solid #e0e0e0;
      border-radius: 4px;
      padding: 1rem;
      max-height: 300px;
      overflow-y: auto;
    }
    .event-item {
      padding: 0.75rem;
      border-bottom: 1px solid #e0e0e0;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }
    .event-item:last-child {
      border-bottom: none;
    }
    .event-check {
      width: 18px;
      height: 18px;
    }
    .event-info {
      flex: 1;
    }
    .event-title {
      font-weight: 500;
      color: #16171a;
    }
    .event-date {
      font-size: 0.875rem;
      color: #666;
      margin-top: 0.25rem;
    }
    .no-events {
      text-align: center;
      padding: 2rem;
      color: #666;
    }
    .button-group {
      display: flex;
      gap: 1rem;
      margin-top: 2rem;
    }
    .btn {
      padding: 0.875rem 2rem;
      border: none;
      border-radius: 4px;
      font-size: 0.9375rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }
    .btn:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }
    .btn-primary {
      background: #4271ae;
      color: white;
    }
    .btn-primary:hover:not(:disabled) {
      background: #365a8c;
    }
    .btn-secondary {
      background: #10b981;
      color: white;
    }
    .btn-secondary:hover:not(:disabled) {
      background: #059669;
    }
    .btn-back {
      background: #f0f0f0;
      color: #16171a;
    }
    .btn-back:hover {
      background: #e0e0e0;
    }
    .spinner {
      display: none;
      width: 18px;
      height: 18px;
      border: 2px solid #ffffff;
      border-top-color: transparent;
      border-radius: 50%;
      animation: spin 0.8s linear infinite;
    }
    .btn.loading .spinner {
      display: block;
    }
    .btn.loading .btn-text {
      display: none;
    }
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
    .message {
      padding: 1rem 1.5rem;
      border-radius: 4px;
      margin-bottom: 1.5rem;
      display: none;
    }
    .message.success {
      background-color: #d1fae5;
      color: #065f46;
      border: 1px solid #10b981;
      display: block;
    }
    .message.error {
      background-color: #fee2e2;
      color: #991b1b;
      border: 1px solid #ef4444;
      display: block;
    }
    .help-text {
      font-size: 0.875rem;
      color: #666;
      margin-top: 0.5rem;
    }
    .image-preview {
      max-width: 200px;
      margin-top: 0.75rem;
      border-radius: 4px;
      display: none;
    }
    .image-preview.show {
      display: block;
    }
  </style>
</head>
<body>
  <div class="panel-header">
    <h1>
      <span>📧</span>
      Newsletter Generator
    </h1>
  </div>
  
  <div class="container">
    <div id="message" class="message"></div>
    
    <form id="newsletterForm">
      <div class="card">
        <h2 style="margin-bottom: 1.5rem; font-size: 1.25rem;">Newsletter Einstellungen</h2>
        
        <div class="form-group">
          <label for="monthYear">Monat</label>
          <input 
            type="month" 
            id="monthYear" 
            name="monthYear" 
            value="<?= date('Y-m', strtotime('+1 month')) ?>"
            required>
          <div class="help-text">Wähle den Monat für die Events im Newsletter</div>
        </div>
        
        <div class="form-group">
          <label for="welcomeText">Willkommenstext</label>
          <textarea 
            id="welcomeText" 
            name="welcomeText" 
            placeholder="Hallo liebe Freund:innen,&#10;&#10;hier sind die kommenden Veranstaltungen..."
            required></textarea>
          <div class="help-text">Dieser Text erscheint am Anfang des Newsletters</div>
        </div>
        
        <div class="form-group">
          <label for="imageUrl">Bild des Monats</label>
          <div class="file-input">
            <input 
              type="text" 
              id="imageUrl" 
              name="imageUrl" 
              placeholder="https://... oder leer lassen">
            <button type="button" onclick="openFileBrowser()">Datei wählen</button>
          </div>
          <img id="imagePreview" class="image-preview" alt="Preview">
          <div class="help-text">Optional: Füge ein Highlight-Bild für diesen Monat hinzu</div>
        </div>
        
        <div class="form-group">
          <label for="goodbyeText">Abschlusstext</label>
          <textarea 
            id="goodbyeText" 
            name="goodbyeText" 
            placeholder="Wir freuen uns auf euren Besuch!&#10;&#10;Bis bald,&#10;Das Team"></textarea>
          <div class="help-text">Dieser Text erscheint nach allen Events</div>
        </div>
      </div>
      
      <div class="card">
        <h2 style="margin-bottom: 1.5rem; font-size: 1.25rem;">
          Events <span id="eventCount" style="color: #666; font-weight: 400;"></span>
        </h2>
        <div id="eventsList" class="events-list">
          <div class="no-events">Events werden geladen...</div>
        </div>
      </div>
      
      <div class="button-group">
        <button type="button" id="btnDraft" class="btn btn-primary">
          <span class="btn-text">✏️ Draft in Brevo erstellen</span>
          <span class="spinner"></span>
        </button>
        
        <button type="button" id="btnSendNow" class="btn btn-secondary">
          <span class="btn-text">🚀 Sofort senden</span>
          <span class="spinner"></span>
        </button>
        
        <a href="/panel" class="btn btn-back">← Zurück zum Panel</a>
      </div>
    </form>
  </div>
  
  <script>
    let currentEvents = [];
    
    // Load events when month changes
    document.getElementById('monthYear').addEventListener('change', loadEvents);
    
    // Load events on page load
    loadEvents();
    
    async function loadEvents() {
      const monthYear = document.getElementById('monthYear').value;
      const [year, month] = monthYear.split('-');
      
      try {
        const response = await fetch(`/brevo-newsletter/events/${year}/${month}`);
        const data = await response.json();
        
        currentEvents = data.events || [];
        displayEvents(currentEvents);
      } catch (error) {
        console.error('Error loading events:', error);
        showMessage('Fehler beim Laden der Events', 'error');
      }
    }
    
    function displayEvents(events) {
      const container = document.getElementById('eventsList');
      const countEl = document.getElementById('eventCount');
      
      if (events.length === 0) {
        container.innerHTML = '<div class="no-events">Keine Events für diesen Monat</div>';
        countEl.textContent = '(0)';
        return;
      }
      
      countEl.textContent = `(${events.length})`;
      
      container.innerHTML = events.map(event => `
        <div class="event-item">
          <input type="checkbox" class="event-check" value="${event.id}" checked disabled>
          <div class="event-info">
            <div class="event-title">${event.title}</div>
            <div class="event-date">${event.date}</div>
          </div>
        </div>
      `).join('');
    }
    
    function openFileBrowser() {
      // Open Kirby's file browser (panel integration would be needed)
      // For now, just prompt for URL
      const url = prompt('Bild-URL eingeben:');
      if (url) {
        document.getElementById('imageUrl').value = url;
        updateImagePreview(url);
      }
    }
    
    function updateImagePreview(url) {
      const preview = document.getElementById('imagePreview');
      if (url) {
        preview.src = url;
        preview.classList.add('show');
      } else {
        preview.classList.remove('show');
      }
    }
    
    document.getElementById('imageUrl').addEventListener('input', (e) => {
      updateImagePreview(e.target.value);
    });
    
    function showMessage(text, type = 'info') {
      const messageEl = document.getElementById('message');
      messageEl.textContent = text;
      messageEl.className = 'message ' + type;
      messageEl.scrollIntoView({ behavior: 'smooth' });
      
      if (type === 'success') {
        setTimeout(() => {
          messageEl.style.display = 'none';
        }, 5000);
      }
    }
    
    function setLoading(button, loading) {
      button.disabled = loading;
      if (loading) {
        button.classList.add('loading');
      } else {
        button.classList.remove('loading');
      }
    }
    
    async function apiRequest(endpoint, data = {}) {
      const response = await fetch(endpoint, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
      });
      
      return await response.json();
    }
    
    // Generate Draft
    document.getElementById('btnDraft').addEventListener('click', async function() {
      const formData = {
        monthYear: document.getElementById('monthYear').value,
        welcomeText: document.getElementById('welcomeText').value,
        imageUrl: document.getElementById('imageUrl').value,
        goodbyeText: document.getElementById('goodbyeText').value,
        events: currentEvents
      };
      
      if (!formData.welcomeText) {
        showMessage('Bitte Willkommenstext eingeben', 'error');
        return;
      }
      
      if (currentEvents.length === 0) {
        if (!confirm('Keine Events für diesen Monat. Trotzdem fortfahren?')) {
          return;
        }
      }
      
      setLoading(this, true);
      
      try {
        const result = await apiRequest('/brevo-newsletter/create-draft-form', formData);
        
        if (result.success) {
          showMessage('✓ Draft erstellt! Öffne Brevo Editor...', 'success');
          
          if (result.data && result.data.campaignUrl) {
            setTimeout(() => {
              window.open(result.data.campaignUrl, '_blank');
            }, 500);
          }
        } else {
          showMessage('✗ Fehler: ' + result.message, 'error');
        }
      } catch (error) {
        showMessage('✗ Fehler: ' + error.message, 'error');
      } finally {
        setLoading(this, false);
      }
    });
    
    // Send Now
    document.getElementById('btnSendNow').addEventListener('click', async function() {
      const formData = {
        monthYear: document.getElementById('monthYear').value,
        welcomeText: document.getElementById('welcomeText').value,
        imageUrl: document.getElementById('imageUrl').value,
        goodbyeText: document.getElementById('goodbyeText').value,
        events: currentEvents
      };
      
      if (!formData.welcomeText) {
        showMessage('Bitte Willkommenstext eingeben', 'error');
        return;
      }
      
      if (!confirm('⚠️ ACHTUNG: Newsletter wird SOFORT an ALLE Abonnenten versendet!\n\nBist du sicher?')) {
        return;
      }
      
      if (!confirm('Wirklich jetzt senden? Dies kann nicht rückgängig gemacht werden!')) {
        return;
      }
      
      setLoading(this, true);
      
      try {
        const result = await apiRequest('/brevo-newsletter/send-now-form', formData);
        
        if (result.success) {
          showMessage('✓ Newsletter wird versendet!', 'success');
        } else {
          showMessage('✗ Fehler: ' + result.message, 'error');
        }
      } catch (error) {
        showMessage('✗ Fehler: ' + error.message, 'error');
      } finally {
        setLoading(this, false);
      }
    });
  </script>
</body>
</html>

