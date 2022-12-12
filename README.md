# HTML Notes

HTML Notes is a lightweight design system written in HTML, CSS, Javascript, with a splash of PHP. The primary goal of this system is to neatly organize an entire collection of notes into a single page.

It favors plain text files, self-custody, client-side encryption, and freedom from proprietary file formats (closed ecosystems).

If you're a meticulous note taker, expending the time and effort to format and style your notes — *you may as well be using HTML and CSS to do it!*

This system provides a single source of truth that is easily accessible from any device connected to the internet. Increase privacy and security by hosting it locally, or by hard coding everything into one single html file.

## Pros
* Private. Client-side encryption (AES) means you can host your files anywhere with confidence.
* No server required. This can be hosted locally with a basic php server.
* Self-custody. No ads, no tracking, no third parties, no compilations, no builds.
* No database. Uses plain text files.
* Lightening fast load times.
* Search is instantaneous because all the data is on a single page.
* Keep all your notes in one place. Prevent the spread/duplication of files across devices, applications, and directories.
* Edit notes directly in the browser or in your favorite text editor.
* Designed for mobile.
* Keyboard accessible with tabbed navigation.
* Super lightweight.

## Cons
* Need to be an organized and meticulous note taker.
* You must completely trust whoever has access to this site. It would be a security nightmare otherwise.
* Knowledge of html required.
* Adding new sections and files is still a manual process.
* Using a code editor (IDE) is the most powerful experience.
* Once files are encrypted, the only reasonable way to edit them is through the browser.

### Example
https://example.html-notes.app/

Encryption disabled for ease of use. Saving notes disabled for security.

### Important
* A fair amount of traditional front-end web development knowledge and work is required to set up. Afterwards, the maintenance is elementary and updating notes can be done from the browser.
* Encryption is using CryptoJS and temporarily storing the passphrase in the browser session storage. This is vulnerable to XSS attacks but is fairly secure otherwise. The main reason for the encryption is to prevent the web-host from snooping. True secrecy would require more.
* A passcode cannot be changed after it is used. However, you could copy and paste the unencrypted code back into your files and start over. Using more than one passcode to encrypt data will break the site.

### Basic Anatomy

Each individual note (category) uses the following HTML structure.

    <details id="aNote" class="notes__details">
      <summary><strong>A Note</strong>
        <button title="Edit A Note" type="button"><span>Edit</span></button>
      </summary>
      <div class="notes__sections">
        <section class="bkm__section">
          <ul>
            <li><a href="https://link.com" noreferrer="">Bookmark</a></li>
          </ul>
        </section>
        <section class="note__section">
          <h3>Generic note section</h3>
          <ul>
              <li>Item 1</li>
              <li>Item 2</li>
              <li>Item 3</li>
          </ul>
        </section>
      </div>
    </details>

A single note/file can contain multiple sections where the content is stored. The first section is a list of bookmarks (my preference), followed by any number of additional sections.

### Config File
    const useEncryption = true;
    const notesDirectory = "notes/";
    const notes = [
        { "id" : "Groceries", "dir" : "Health/Nutrition/groceries.html" },
        { "id" : "Recipies",  "dir" : "Health/Nutrition/recipies.html" },
        { "id" : "News",      "dir" : "news.html" },
        { "id" : "To-Do",     "dir" : "to-do.html" }
    ];

This config defines the containers for each category of notes based on their directory structure.

The id of each category will be used for the name of each respective note category. Hence, the capitalization. The same is true for the directories.

Once the index file has loaded, the site will check for a locally stored passphrase. If one is not found, a prompt will persist until one is entered. Javascript will decrypt any encrypted sections and the site will be ready.

Unencrypted notes will have a pink background when useEncryption is enabled. Edit the note from the browser and save to encrypt it. The passphrase in session storage is used to encrypt.

Why are the notes being added to localStorage? Experimentation with offline use.

### What inspired this specific implementation?

Simplicity is divine.

I am toying with the notion of a SFA (Single File Application). A lightweight, highly performant, single purpose variant of the SPA. No frameworks, no dependencies, no bloat.

"What about all of these files?", you may ask. They are split out to make life easier (see Basic Anatomy). However, this page could easily be converted into a single, static html file including all the content, CSS, and Javascript (inline).
