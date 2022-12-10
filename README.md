# HTML Notes

HTML Notes is an incredibly lightweight design system written in HTML, CSS, Javascript, and PHP. The primary goal of this system is to neatly organize an entire collection of notes into a single page.

It favors plain text files, self-custody, client-side encryption, and freedom from proprietary file formats (and applications) that lock you into closed ecosystems.

If you're a meticulous note taker, expending the time and effort to format and style your notes, **"You may as well be using HTML and CSS to do it!"**

This system provides a single source of truth that is easily accessible from any device connected to the internet. It can also be easily hosted locally (with a simple PHP server) to maintain complete privacy and security.

### Pros
* Private. Client-side encryption (AES) means you can host your files anywhere with confidence.
* No server required. This can be hosted locally with a basic php server.
* Self-custody. No ads, no tracking, no third parties, no compilations, no builds.
* No database. Uses plain text files.
* Lightening fast load times.
* Search is instantaneous because all the data is on a single page.
* Keep all your notes in one place. Prevent the spread / duplication of files across devices, applications, and directories.
* Edit notes directly in the browser or in your favorite text editor.
* Designed for mobile.
* Keyboard accessible with tabbed navigation.
* Super lightweight. The entire site, including 60+ notes is ~ 400 kB.

### Cons
* Need to be an organized and meticulous note taker.
* You must completely trust whoever has access to this site. It would be security nightmare otherwise.
* Knowledge of html required.
* Adding new sections and files is still a manual process.
* Using a code editor (IDE) is the most powerful experience.
* Once files are encrypted, the only reasonable way to edit them is through the browser.

### Important

#### THIS SITE IS A HACKERS DREAM! PASSWORD PROTECT IT! ONLY ALLOW PEOPLE YOU TRUST IMPLICITLY TO ACCESS IT!
#### Encryption is using CryptoJS and temporarily storing the passphrase in the browser session storage. This is vulnerable to XSS attacks but is otherwise fairly secure. The main reason for the encryption is to prevent the web-host from snooping. True secrecy will require more.
#### A passcode cannot be changed after it is used. However, you could copy and paste the unencrypted code back into your files and start over. Using more than one passcode to encrypt data will break the site.
#### A fair amount of traditional front-end web development knowledge and work is required to set up. However, once this is done, the maintenance is elementary and updating notes can be done from the browser.

### What inspired this specific implementation?

The mantra is simplicity.

I am toying with the notion of a SFA (Single File Application). A lightweight, highly performant, single purpose variant of the SPA. No frameworks, no dependencies, no bloat.

Simplicity makes the app easier to use and to maintain.

"What about all of these files?", you may ask. They are split out to make life easier (see Basic Anatomy). However, this page could easily be converted into a single, static html file including all the content, CSS, and Javascript (inline).


This project is about developing a solution to all of my concerns with current Notes applications and related systems of storage.

It begs the question, "What is a note?"
* Documentation
* Bookmark
* Photo
* Reminder
* Snippet
* Todo list
* Recipe

They all are.

### Basic Anatomy

Each individual note (category) uses the following HTML structure.

	<details id="category">
	    <summary>Category<span></span> <button data-file-directory="notes/category.php" title="Edit Category" id="write" type="button"></button></summary>
	    <div class="grid-sections">
	        <section class="bookmarks">
	            <ul>
	                <li><a href="https://bookmark.com" target="_blank" rel="noreferrer">bookmark</a></li>
	            </ul>
	        </section>
	    </div>
	</details>

A single note can contain multiple sections where the content is stored. The first section is a list of bookmarks (my preference), followed by any number of additional sections. Multiple sections can be in a different order or be omitted entirely.

The sections (contents) are saved in a php file named by note (category). These are encrypted on the first save from the browser. A light pink background means a section **has not** been encrypted yet.

	<div class="grid-sections"><?php include 'notes/category.php'; ?></div>

Once the index file has loaded along with the respective php includes, the site will check for a locally stored passphrase. If one is not found, a prompt will persist until one is entered. Javascript will decrypt any encrypted sections and the site will be ready.

