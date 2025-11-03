# Niehler Freiheit

Website for Niehler Freiheit e.V. - a non-commercial cultural space in Cologne.

## Local Development

### Setup
```bash
composer install
npm install
```

### Run Development Server
```bash
php -S localhost:8080 kirby/router.php
npm run watch  # TailwindCSS (in separate terminal)
```

### Access
- **Website**: http://localhost:8080
- **Panel (CMS)**: http://localhost:8080/panel
- **Newsletter Generator**: http://localhost:8080/newsletter-generator

### Environment Variables
Create `.env` file in project root:
```
BREVO_API_KEY=your_api_key
BREVO_SENDER_EMAIL=hello@niehlerfreiheit.de
```

## Deployment

**Staging**: Push to `staging` branch → Auto-deploys via GitHub Actions (FTP)  
**Production**: Push to `main` branch → Auto-deploys via GitHub Actions (FTP)

Environment variables are configured via GitHub Secrets and injected during deployment.

## Newsletter System

Monthly newsletters are created via `/newsletter-generator` (requires panel login).

- Select month/year and add welcome text
- Upload "Picture of the Month" (optional)
- Preview events for selected month
- Creates draft campaign in Brevo
- Opens Brevo editor in new tab for final review/sending

## Tech Stack

- **CMS**: [Kirby](https://getkirby.com)
- **CSS**: [TailwindCSS](https://tailwindcss.com)
- **Email**: [Brevo API](https://developers.brevo.com)
