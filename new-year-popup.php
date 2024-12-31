<?php
function new_year_popup_shortcode($atts) {
    // Set default values for image, delay, time, and date
    // Get the WordPress timezone settings
    $timezone = get_option('timezone_string');
    if (!$timezone) {
        $timezone = 'UTC';
    }
    date_default_timezone_set($timezone);

    $current_date = date(get_option('date_format'));
    $current_time = date(get_option('time_format')); 


    $atts = shortcode_atts(
        array(
            'image' => 'https://i.ibb.co/LSrhRy4/New-Year-1.gif', // default image
            'delay' => 5, // default delay time in seconds
            'time' => $current_time, // Default time if not provided
            'date' => $current_date, // Default date if not provided
        ),
        $atts,
        'new_year_popup'
    );

    // Popup HTML
    $popup_html = '
    <div class="overlay" id="overlay-ny-general">
        <div class="popup" id="popup-ny-general" style="background-image:url(' . esc_url($atts['image']) . ')">
            <button class="close-button" onclick="hidePopupNyGeneral()">&times;</button>
            <div class="popup-content">
            </div>
        </div>
    </div>
    <style>
    :root {
        --pop-up-primary-gradient: linear-gradient(135deg, #4F46E5, #7C3AED);
        --pop-up-secondary-gradient: linear-gradient(135deg, #3B82F6, #2563EB);
        --pop-up-text-color: #1F2937;
        --pop-up-bg-color: #F3F4F6;
    }

    .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(6px);
        z-index: 1000;
        animation: fadeIn 0.3s ease-out;
    }

    .popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.7);
        background: white;
        padding: 0px;
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        width: 90%;
        max-width: 480px;
        z-index: 1001;
        opacity: 0;
        transition: all 0.3s ease-out;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }

    .popup.active {
        transform: translate(-50%, -50%) scale(1);
        opacity: 1;
    }

    .close-button {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(243, 244, 246, 0.8);
        border: none;
        font-size: 20px;
        cursor: pointer;
        color: #6B7280;
        padding: 8px;
        line-height: 1;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .close-button:hover {
        background: rgba(243, 244, 246, 1);
        color: #374151;
        transform: rotate(90deg);
    }

    .popup-date-time {
        text-align: center;
        margin-top: 10px;
    }

    .popup-content {
        position: relative;
        width:  400px;
        height: 400px;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    @media (max-width: 640px) {
        .popup {
            width: 95%;
        }
    }
    </style>
    <script>
    function showPopupNyGeneral() {
        const overlay = document.getElementById("overlay-ny-general");
        const popup = document.getElementById("popup-ny-general");
        overlay.style.display = "block";
        setTimeout(() => {
            popup.classList.add("active");
        }, 10);
    }

    function hidePopupNyGeneral() {
        const overlay = document.getElementById("overlay-ny-general");
        const popup = document.getElementById("popup-ny-general");
        popup.classList.remove("active");
        setTimeout(() => {
            overlay.style.display = "none";
        }, 300);
    }

    function showPopupOnce() {
        const pageKey = "new-year";
        const targetDate = "' . esc_js($atts['date']) . '";
        const targetTime = "' . esc_js($atts['time']) . '";

        const targetDateTime = new Date(targetDate + " " + targetTime).getTime();
        const currentTime = new Date().getTime();

        if (currentTime >= targetDateTime && !getCookie(pageKey)) {
            setTimeout(showPopupNyGeneral, 5000);
            setCookie(pageKey, "true", 3);
        }
    }

    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(";").shift();
        return null;
    }

    function setCookie(name, value, hours) {
        const d = new Date();
        d.setTime(d.getTime() + (hours * 60 * 60 * 1000));
        const expires = `expires=${d.toUTCString()}`;
        document.cookie = `${name}=${value}; ${expires}; path=/`;
    }

    setTimeout(showPopupOnce, ' . (intval($atts['delay']) * 1000) . ');
    </script>';

    return $popup_html;
}

add_shortcode('new_year_popup', 'new_year_popup_shortcode');

add_action('wp_footer', 'new_year_wish');
function new_year_wish() {
    echo do_shortcode('[new_year_popup delay="8" date="2024-12-31" time="10:00 AM"]');
}
?>
