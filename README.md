# New Year Popup Shortcode for WordPress

This is a custom WordPress shortcode that displays a New Year-themed popup on the page after a specified delay. The popup can be customized with an image, date, and time for the popup to appear. It includes a fun animation with a close button and a custom message or image.

## Features

- **Customizable Popup Image**: You can set the image that appears in the popup.
- **Time-Based Popup Display**: The popup shows up based on a specific date and time.
- **Delay Before Popup**: You can specify a delay before the popup is shown.
- **Cookie-Based Display**: Ensures the popup is shown only once per user, based on cookies.
- **Responsive Design**: The popup is optimized for different screen sizes.

## Shortcode Usage

To use the shortcode, simply insert the following code into any post or page:

```
[new_year_popup delay="8" date="2024-12-31" time="10:00 AM"]
```

## Attributes:
 - image: (Optional) The URL of the image to display in the popup. Default is a New Year GIF.
 - delay: (Optional) The delay in seconds before the popup appears. Default is 5.
 - date: (Optional) The target date for the popup to display. Defaults to the current date.
 - time: (Optional) The target time for the popup to display. Defaults to the current time.

## Example

```
[new_year_popup image="https://example.com/new-year-image.gif" delay="10" date="2024-12-31" time="11:59 PM"]
```

## How It Works
 - Popup HTML: A popup div is created with the specified image and content.
 - Styling: Custom CSS is applied to ensure the popup looks great and is responsive.
 - JavaScript:
   - A script waits for the specified delay and checks if the current time is greater than or equal to the target date and time.
   - If conditions are met, the popup appears with a fade-in effect.
   - Cookies are used to ensure that the popup only appears once for each user.

## Installation
 - Copy the PHP code from the new_year_popup_shortcode function and the wp_footer action into your theme's functions.php file or a custom plugin.
 - Use the shortcode [new_year_popup] in any post or page to display the popup.

## Customization
 - You can adjust the default image by changing the URL in the image attribute.
 - The popup appearance (like background color, borders, etc.) can be customized by modifying the included CSS in the popup_html.
 - The animation, popup size, and content styling can be easily adjusted by editing the CSS rules inside the style tag.

## Example of Usage
Add this to the footer of your WordPress site (in the wp_footer hook):
```
add_action('wp_footer', 'new_year_wish');
function new_year_wish() {
    echo do_shortcode('[new_year_popup delay="8" date="2024-12-31" time="10:00 AM"]');
}
```
This will automatically show the popup on December 31, 2024, at 10:00 AM with an 8-second delay.
