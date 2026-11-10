# Setting up the APTERS website on Infratel

These steps assume your Infratel hosting uses **cPanel** (the usual control panel). Menu names may differ slightly. If something doesn't match, ask Infratel support: "Please install WordPress on my domain and turn on SSL."

## 1. Install WordPress
1. Log in to your Infratel hosting control panel (cPanel).
2. Find **WordPress** under *Software* or *Installatron* / *Softaculous*. Click **Install**.
3. Choose your domain. Leave the folder empty so the site lives at the main address.
4. Set the **site title** to "APTERS Zambia" and create an **administrator** username and a strong password. Save these somewhere safe.
5. Finish the install and open **yourdomain/wp-admin** to check you can log in.

## 2. Turn on HTTPS (SSL)
1. In cPanel, open **SSL/TLS Status** or **Let's Encrypt SSL** and install a certificate for the domain (often free).
2. In WordPress, go to **Settings > General**. Make sure both address fields start with `https://`.

## 3. Set permalinks
Go to **Settings > Permalinks**, choose **Post name**, and click **Save Changes**. This makes the Events page work.

## 4. Upload the APTERS theme
1. Go to **Appearance > Themes > Add New > Upload Theme**.
2. Choose `apters-theme.zip` (from the `site/wordpress` folder) and click **Install Now**.
3. Click **Activate**.
4. The home page now uses the APTERS design. Check the live site.

## 5. Add the contact form (optional but recommended)
1. Go to **Plugins > Add New**, search for **Contact Form 7**, and click **Install Now**, then **Activate**.
2. Go to **Contact > Add New**. Set the form **title to exactly "Contact"** (the home page looks for this name), keep the default fields, and click **Save**.
3. The home page then shows this form automatically. You can change the fields under **Contact**.

## 6. Set up the site content
1. **Customize**: Appearance > Customize > APTERS Settings. Enter the email, phone, hours, address, bank details, social links, and upload a home photo. Click **Publish**.
2. **Team**: add each team member (name, role, photo, short bio).
3. **Sponsorships**: add each device with its price in KW (numbers only).
4. **Events**: add any upcoming events.
5. Use the staff guide (`STAFF-GUIDE.md`) for the detailed steps.

## 7. Create staff accounts
1. Go to **Users > Add New**.
2. Enter the staff member's email and choose the role:
   - **Editor**: can publish events, team and sponsorships, and edit pages. Recommended for most staff.
   - **Administrator**: full control. Keep this to one or two trusted people.
3. Ask each person to set their own password and log in once to check access.

## 8. Protect and back up the site
- Install **UpdraftPlus** (free) or ask Infratel to enable **daily backups**. Keep at least one backup copy off the server.
- Keep WordPress, the theme and plugins updated. WordPress will show a notice when updates are available.
- Use a strong password for every account, and do not share the administrator login.
- Limit login attempts: install **Limit Login Attempts Reloaded** (free) or ask Infratel for brute-force protection.

## 9. Check before going live
- [ ] Home page loads over `https://` and shows the photo, events, team, sponsorships and contact details.
- [ ] Menu links jump to the right sections.
- [ ] Events page lists events, and each event opens.
- [ ] Contact form sends a test message (if installed).
- [ ] Looks right on a phone and on a computer.
- [ ] A staff member can add an event and see it appear.

## Troubleshooting
- **Page shows "Hello world" or a blank theme:** check the theme is activated under Appearance > Themes.
- **Events page shows a 404 error:** re-save **Settings > Permalinks**.
- **Photos will not upload:** the file is too big. Resize it (under about 2 MB), or ask Infratel to raise the upload limit.
- **Changes do not appear:** clear the cache (if a caching plugin is installed) and refresh with Ctrl+F5.
- **Email or phone missing on home page:** fill them in under Appearance > Customize > APTERS Settings.

## Who to contact
- Hosting, domain, SSL, backups: Infratel support.
- Design or content changes: the web team that built the site.
