<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Brevo Newsletter Preview</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background-color: #f5f5f5;
      padding: 20px;
    }
    .container {
      max-width: 1400px;
      margin: 0 auto;
    }
    .header {
      background-color: #ffffff;
      padding: 30px;
      border-radius: 8px;
      margin-bottom: 20px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .header h1 {
      font-size: 28px;
      margin-bottom: 10px;
      color: #000000;
    }
    .header p {
      color: #666666;
      font-size: 14px;
    }
    .controls {
      background-color: #ffffff;
      padding: 30px;
      border-radius: 8px;
      margin-bottom: 20px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .controls h2 {
      font-size: 18px;
      margin-bottom: 20px;
      color: #000000;
    }
    .button-group {
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }
    .btn {
      padding: 12px 24px;
      border: none;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }
    .btn:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }
    .btn-test {
      background-color: #3b82f6;
      color: white;
    }
    .btn-test:hover:not(:disabled) {
      background-color: #2563eb;
    }
    .btn-draft {
      background-color: #8b5cf6;
      color: white;
    }
    .btn-draft:hover:not(:disabled) {
      background-color: #7c3aed;
    }
    .btn-send {
      background-color: #10b981;
      color: white;
    }
    .btn-send:hover:not(:disabled) {
      background-color: #059669;
    }
    .btn-schedule {
      background-color: #f59e0b;
      color: white;
    }
    .btn-schedule:hover:not(:disabled) {
      background-color: #d97706;
    }
    .btn-back {
      background-color: #6b7280;
      color: white;
    }
    .btn-back:hover {
      background-color: #4b5563;
    }
    .schedule-input {
      display: none;
      margin-top: 15px;
      padding: 15px;
      background-color: #f9fafb;
      border-radius: 6px;
    }
    .schedule-input.active {
      display: block;
    }
    .schedule-input label {
      display: block;
      font-size: 14px;
      font-weight: 500;
      margin-bottom: 8px;
      color: #374151;
    }
    .schedule-input input {
      width: 100%;
      padding: 10px;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      font-size: 14px;
      margin-bottom: 10px;
    }
    .schedule-input .btn-group {
      display: flex;
      gap: 10px;
      margin: 0;
    }
    .message {
      padding: 15px 20px;
      border-radius: 6px;
      margin-bottom: 20px;
      font-size: 14px;
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
    .message.info {
      background-color: #dbeafe;
      color: #1e40af;
      border: 1px solid #3b82f6;
      display: block;
    }
    .event-info {
      background-color: #f9fafb;
      padding: 20px;
      border-radius: 6px;
      margin-bottom: 20px;
    }
    .event-info h3 {
      font-size: 16px;
      margin-bottom: 10px;
      color: #000000;
    }
    .event-info p {
      font-size: 14px;
      color: #666666;
      margin-bottom: 5px;
    }
    .preview {
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      overflow: hidden;
    }
    .preview-header {
      background-color: #f3f4f6;
      padding: 15px 20px;
      border-bottom: 1px solid #e5e7eb;
    }
    .preview-header h3 {
      font-size: 16px;
      color: #374151;
    }
    .preview-body {
      padding: 20px;
      background-color: #f5f5f5;
    }
    iframe {
      width: 100%;
      min-height: 800px;
      border: none;
      background-color: white;
      border-radius: 4px;
    }
    .spinner {
      display: none;
      width: 20px;
      height: 20px;
      border: 3px solid #ffffff;
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
    .warning {
      background-color: #fef3c7;
      border: 1px solid #f59e0b;
      color: #92400e;
      padding: 15px 20px;
      border-radius: 6px;
      margin-bottom: 20px;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>📧 Brevo Newsletter Preview</h1>
      <p>Vorschau, Test senden und Newsletter versenden</p>
    </div>
    
    <div class="controls">
      <h2>Newsletter-Aktionen</h2>
      
      <div id="message" class="message"></div>
      
      <div class="event-info">
        <h3>Enthaltene Events: <?= $events->count() ?></h3>
        <?php if ($events->count() > 0): ?>
          <?php foreach ($events as $event): ?>
            <p>• <?= $event->title()->html() ?> - <?= $event->date()->toDate('dd.MM.Y') ?></p>
          <?php endforeach; ?>
          
          <details style="margin-top: 15px;">
            <summary style="cursor: pointer; font-weight: 600; color: #3b82f6;">📋 Events als Text kopieren (für manuelles Einfügen in Brevo)</summary>
            <textarea readonly style="width: 100%; min-height: 200px; margin-top: 10px; padding: 10px; font-family: monospace; font-size: 13px; border: 1px solid #d1d5db; border-radius: 4px;" onclick="this.select(); document.execCommand('copy'); alert('In Zwischenablage kopiert!');"><?php foreach ($events as $event): ?>
━━━━━━━━━━━━━━━━━━━━━━━━
<?= $event->title()->html() ?>

📅 Datum: <?= $event->date()->toDate('EEEE, dd. MMMM Y') ?>

<?php if ($event->admissiontime()->isNotEmpty()): ?>
🚪 Einlass: <?= $event->admissiontime()->toDate('H:mm') ?> Uhr
<?php endif; ?>
⏰ Beginn: <?= $event->starttime()->toDate('H:mm') ?> Uhr
🏷️ Kategorie: <?= $event->category()->html() ?>

<?= $event->text()->excerpt(300)->html() ?>

🔗 Mehr: <?= $event->url() ?>


<?php endforeach; ?>
━━━━━━━━━━━━━━━━━━━━━━━━</textarea>
          </details>
        <?php else: ?>
          <p>⚠️ Keine kommenden Events gefunden</p>
        <?php endif; ?>
      </div>
      
      <?php if ($events->count() > 0): ?>
        <div class="button-group">
          <button id="btnSendTest" class="btn btn-test">
            <span class="btn-text">📨 Test-Email senden</span>
            <span class="spinner"></span>
          </button>
          
          <button id="btnCreateDraft" class="btn btn-draft">
            <span class="btn-text">✏️ Draft in Brevo erstellen</span>
            <span class="spinner"></span>
          </button>
          
          <button disabled id="btnSendNow" class="btn btn-send">
            <span class="btn-text">🚀 Jetzt an alle senden</span>
            <span class="spinner"></span>
          </button>
          
          <button id="btnSchedule" class="btn btn-schedule">
            <span class="btn-text">📅 Versand planen</span>
          </button>
          
          <a href="/panel" class="btn btn-back">← Zurück zum Panel</a>
        </div>
        
        <div id="scheduleInput" class="schedule-input">
          <label for="scheduledAt">Versandzeitpunkt (lokale Zeit):</label>
          <input 
            type="datetime-local" 
            id="scheduledAt" 
            name="scheduledAt"
            min="<?= date('Y-m-d\TH:i') ?>"
          >
          <div class="btn-group">
            <button id="btnConfirmSchedule" class="btn btn-schedule">
              <span class="btn-text">✓ Versand bestätigen</span>
              <span class="spinner"></span>
            </button>
            <button id="btnCancelSchedule" class="btn btn-back">Abbrechen</button>
          </div>
        </div>
        
        <div class="warning">
          <strong>💡 Empfohlen:</strong> Nutze <strong>"✏️ Draft in Brevo erstellen"</strong> um den Newsletter im Brevo-Editor zu bearbeiten, bevor du ihn versendest.<br>
          <strong>⚠️ Wichtig:</strong> "Jetzt senden" versendet den Newsletter sofort an alle Abonnenten ohne weitere Bearbeitungsmöglichkeit!
        </div>
      <?php else: ?>
        <div class="warning">
          <strong>⚠️ Keine Events:</strong> Es sind keine kommenden Events vorhanden. Ein Newsletter kann nicht versendet werden.
        </div>
        <a href="/panel" class="btn btn-back">← Zurück zum Panel</a>
      <?php endif; ?>
    </div>
    
    <div class="preview">
      <div class="preview-header">
        <h3>Email-Vorschau</h3>
      </div>
      <div class="preview-body">
        <iframe srcdoc="<?= htmlspecialchars($emailHtml) ?>"></iframe>
      </div>
    </div>
  </div>
  
  <script>
    const messageEl = document.getElementById('message');
    
    function showMessage(text, type = 'info') {
      messageEl.textContent = text;
      messageEl.className = 'message ' + type;
      messageEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      
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
    
    // Send Test Email
    document.getElementById('btnSendTest')?.addEventListener('click', async function() {
      if (!confirm('Test-Email senden? Die Email wird an die in der Konfiguration hinterlegte Test-Adresse gesendet.')) {
        return;
      }
      
      setLoading(this, true);
      
      try {
        const result = await apiRequest('/brevo-newsletter/send-test');
        
        if (result.success) {
          showMessage('✓ ' + result.message, 'success');
        } else {
          showMessage('✗ Fehler: ' + result.message, 'error');
        }
      } catch (error) {
        showMessage('✗ Fehler beim Senden: ' + error.message, 'error');
      } finally {
        setLoading(this, false);
      }
    });
    
    // Create Draft Campaign
    document.getElementById('btnCreateDraft')?.addEventListener('click', async function() {
      if (!confirm('Draft-Kampagne in Brevo erstellen?\n\nDie Kampagne wird als Entwurf gespeichert und öffnet sich im Brevo-Editor, wo du sie bearbeiten und versenden kannst.')) {
        return;
      }
      
      setLoading(this, true);
      
      try {
        const result = await apiRequest('/brevo-newsletter/create-draft');
        
        if (result.success) {
          showMessage('✓ ' + result.message + ' - Öffne Brevo Editor...', 'success');
          
          // Open Brevo editor in new tab
          if (result.data && result.data.campaignUrl) {
            setTimeout(() => {
              window.open(result.data.campaignUrl, '_blank');
            }, 500);
          }
        } else {
          showMessage('✗ Fehler: ' + result.message, 'error');
        }
      } catch (error) {
        showMessage('✗ Fehler beim Erstellen: ' + error.message, 'error');
      } finally {
        setLoading(this, false);
      }
    });
    
    // Send Now
    document.getElementById('btnSendNow')?.addEventListener('click', async function() {
      if (!confirm('⚠️ ACHTUNG: Newsletter wird SOFORT an ALLE Abonnenten versendet!\n\nBist du sicher?')) {
        return;
      }
      
      // Double confirmation
      if (!confirm('Wirklich jetzt senden? Dies kann nicht rückgängig gemacht werden!')) {
        return;
      }
      
      setLoading(this, true);
      
      try {
        const result = await apiRequest('/brevo-newsletter/send-now');
        
        if (result.success) {
          showMessage('✓ ' + result.message, 'success');
        } else {
          showMessage('✗ Fehler: ' + result.message, 'error');
        }
      } catch (error) {
        showMessage('✗ Fehler beim Senden: ' + error.message, 'error');
      } finally {
        setLoading(this, false);
      }
    });
    
    // Show Schedule Input
    document.getElementById('btnSchedule')?.addEventListener('click', function() {
      document.getElementById('scheduleInput').classList.add('active');
      
      // Set default to tomorrow at 10:00
      const tomorrow = new Date();
      tomorrow.setDate(tomorrow.getDate() + 1);
      tomorrow.setHours(10, 0, 0, 0);
      
      const formatted = tomorrow.toISOString().slice(0, 16);
      document.getElementById('scheduledAt').value = formatted;
    });
    
    // Cancel Schedule
    document.getElementById('btnCancelSchedule')?.addEventListener('click', function() {
      document.getElementById('scheduleInput').classList.remove('active');
    });
    
    // Confirm Schedule
    document.getElementById('btnConfirmSchedule')?.addEventListener('click', async function() {
      const scheduledAt = document.getElementById('scheduledAt').value;
      
      if (!scheduledAt) {
        showMessage('Bitte wähle einen Versandzeitpunkt', 'error');
        return;
      }
      
      // Convert to ISO 8601 format for Brevo API
      const date = new Date(scheduledAt);
      const isoDate = date.toISOString();
      
      if (!confirm(`Newsletter wird geplant für:\n${date.toLocaleString('de-DE')}\n\nFortfahren?`)) {
        return;
      }
      
      setLoading(this, true);
      
      try {
        const result = await apiRequest('/brevo-newsletter/schedule', {
          scheduledAt: isoDate
        });
        
        if (result.success) {
          showMessage('✓ ' + result.message, 'success');
          document.getElementById('scheduleInput').classList.remove('active');
        } else {
          showMessage('✗ Fehler: ' + result.message, 'error');
        }
      } catch (error) {
        showMessage('✗ Fehler beim Planen: ' + error.message, 'error');
      } finally {
        setLoading(this, false);
      }
    });
  </script>
</body>
</html>

