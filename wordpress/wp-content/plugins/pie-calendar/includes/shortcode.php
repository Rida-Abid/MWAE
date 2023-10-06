<?php

add_shortcode("piecal", "piecal_render_calendar");

if ( ! function_exists( 'piecal_render_calendar' ) ) {

    function piecal_render_calendar( $atts ) {

        $atts = apply_filters('piecal_shortcode_atts', $atts);
        
        $args = [
            'post_type'     => $atts['type'] ?? 'any',
            'post_status'   => 'publish',
            'posts_per_page' => -1,
            'no_found_rows' => true,
            'meta_query'     => [
                'relation' => 'AND',
                [
                    'key'      => '_piecal_is_event',
                    'value'    => '1',
                ],
                [
                    'key'      => '_piecal_start_date',
                    'value'    => '',
                    'compare'  => 'NOT IN'
                ]
            ],
        ];

        $events = new WP_Query( apply_filters('piecal_event_query_args', $args, $atts ) );
        $eventsArray = [];

        // Temporarily remove read more links for our post details
        add_filter('excerpt_more', 'piecal_replace_read_more', 99);

        while( $events->have_posts() ) {
            $events->the_post();
            $startDate = get_post_meta(get_the_ID(), apply_filters( 'piecal_start_date_meta_key', '_piecal_start_date' ) );
            $endDate = get_post_meta(get_the_ID(), apply_filters( 'piecal_end_date_meta_key', '_piecal_end_date' ) );
            $postType = get_post_type_object( get_post_type() );
            $allday = get_post_meta(get_the_ID(), '_piecal_is_allday') ? get_post_meta(get_the_ID(), '_piecal_is_allday', true) : "false";

            $event = [
                "title" => html_entity_decode(get_the_title()),
                "start" => $startDate[0],
                "end" => $endDate[0] ?? null,
                "details" => html_entity_decode(get_the_excerpt()),
                "permalink" => get_permalink(),
                "postType" => $postType->labels->singular_name ?? null
            ];

            if( $allday == true &&
                $allday != "false") {
                $event["allDay"] = $allday;
            }

            $event = apply_filters('piecal_event_array_filter', $event);

            if( $event['postType'] != "null" ) {
                array_push( $eventsArray, $event );
            }
        }

        remove_filter('excerpt_more', 'piecal_replace_read_more', 99);

        $allowedViews = ['dayGridMonth', 'listMonth', 'timeGridWeek', 'listWeek', 'dayGridWeek'];
        $initialView = $atts['view'] ?? 'dayGridMonth';
        
        if( !in_array($initialView, $allowedViews) ) {
            $initialView = 'dayGridMonth';
        }

    wp_enqueue_style('piecalCSS');

    $theme = $atts['theme'] ?? false;

    if( $theme && $theme == 'dark' )
        wp_enqueue_style('piecalThemeDarkCSS');

    if( $theme && $theme == 'adaptive' )
        wp_enqueue_style('piecalThemeDarkCSSAdaptive');

    do_action('piecal_before_core_frontend_scripts');

    wp_enqueue_script('alpinefocus');
    wp_enqueue_script('alpinejs');
    wp_enqueue_script('fullcalendar');

    do_action('piecal_after_core_frontend_scripts');

    $locale = $atts['locale'] ?? get_bloginfo('language');

    if( $locale != 'en-US' ) {
        wp_enqueue_script('fullcalendar-locales');
    }

    $localeDateStringFormat = [
        'hour' => '2-digit',
        'minute' => '2-digit'
    ];

    $localeDateStringFormat = apply_filters( 'piecal_locale_date_string_format', $localeDateStringFormat );

    $allDayLocaleDateStringFormat = [];

    $allDayLocaleDateStringFormat = apply_filters( 'piecal_allday_locale_date_string_format', $allDayLocaleDateStringFormat );

    $wrapperClass = 'piecal-wrapper';

    if( isset( $atts['wraptitles'] ) ) {
        $wrapperClass .= ' piecal-wrap-event-titles';
    }

    $wrapperClass .= apply_filters( 'piecal_wrapper_class', null ) ? " " . apply_filters( 'piecal_wrapper_class', null ) : null;

    ob_start();
    ?>
    <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: "<?php echo esc_attr( $initialView ); ?>",
                    editable: false,
                    events: <?php echo json_encode($eventsArray); ?>,
                    direction: "<?php echo is_rtl() ? 'rtl' : 'ltr'; ?>",
                    contentHeight: "auto",
                    locale: "<?php echo $locale; ?>",
                    eventClick: function( info ) {
                        Alpine.store("calendarEngine").eventTitle = info.event._def.title;
                        Alpine.store("calendarEngine").eventStart = info.event.start;
                        Alpine.store("calendarEngine").eventEnd = info.event.end;
                        Alpine.store("calendarEngine").eventDetails = info.event._def.extendedProps.details;
                        Alpine.store("calendarEngine").eventUrl = info.event._def.extendedProps.permalink;
                        Alpine.store("calendarEngine").eventAllDay = info.event.allDay;
                        Alpine.store("calendarEngine").eventType = info.event._def.extendedProps.postType;
                        Alpine.store('calendarEngine').showPopover = true;
                        Alpine.store('calendarEngine').eventActualEnd = info.event._def.extendedProps.actualEnd;

                        <?php do_action('piecal_additional_event_click_js'); ?>

                        if( info.jsEvent.type == "keydown" ) {
                            setTimeout( () => {
                                document.querySelector('.piecal-popover__inner > button').focus();
                            }, 100);
                        }
                    },
                    eventDataTransform: function(event) {     
                        if(event.allDay && event.end) {

                            let eventStart = new Date(event.start);
                            let comparableEventStart = eventStart.toLocaleDateString('en-us');
                            let eventEnd = new Date(event.end);
                            let comparableEventEnd = eventEnd.toLocaleDateString('en-us');

                            if( comparableEventStart == comparableEventEnd ) return;

                            eventEnd.setDate(eventEnd.getDate());

                            let extendedEndDate = eventEnd.toISOString();

                            extendedEndDate = extendedEndDate.substring(0, extendedEndDate.length - 5);

                            event.actualEnd = event.end; // Save original event end to use in popover
                            event.end = extendedEndDate; // Change event end to show it extending through the last day                                                                                                                                                                                                                                              
                        }
                        return event;  
                    } 
                });
                    calendar.render();
                    window.calendar = calendar;
            });

            function piecalChangeView( view ) {
                window.calendar.changeView(view);
            }

            document.addEventListener('alpine:init', () => {
                Alpine.store('calendarEngine', {
                    showPopover: false,
                    locale: "<?php echo $locale; ?>",
                    localeDateStringFormat: <?php echo json_encode( $localeDateStringFormat ); ?>,
                    allDayLocaleDateStringFormat: <?php echo json_encode( $allDayLocaleDateStringFormat ); ?>,
                    calendarView: "<?php echo esc_attr( $initialView ); ?>",
                    eventTitle: "Loading...",
                    eventDetails: "Loading...",
                    eventType: "Loading...",
                    eventStart: "Loading...",
                    eventAllDay: false,
                    eventActualEnd: null,
                    eventEnd: "Loading...",
                    eventUrl: "/"
                })
            })

            window.addEventListener('keydown', (e) => {
                if( e.keyCode == 27 || e.key == 'Escape' ) Alpine.store('calendarEngine').showPopover = false;

            })
        </script>
        <div 
        class="<?php echo $wrapperClass; ?>" 
        x-data
        >
            <div class="piecal-controls">
                <label>
                    <?php
                    /* Translators: Label for calendar view chooser. */
                    _e('Choose View', 'piecal')
                    ?>
                    <select x-model="$store.calendarEngine.calendarView" @change="piecalChangeView($store.calendarEngine.calendarView)">
                        <option value="dayGridMonth">
                            <?php 
                                /* Translators: String for Month - Classic view in view picker dropdown. */
                                _e( 'Month - Classic', 'piecal' ); 
                            ?>
                        </option>
                        <option value="listMonth">
                            <?php 
                                /* Translators: String for Month - List view in view picker dropdown. */
                                _e( 'Month - List', 'piecal' ); 
                            ?>
                        </option>
                        <option value="timeGridWeek">
                            <?php 
                                /* Translators: String for Week - Time Grid view in view picker dropdown. */
                                _e( 'Week - Time Grid', 'piecal' ); 
                            ?>
                        </option>
                        <option value="listWeek">
                            <?php 
                                /* Translators: String for Week - List view in view picker dropdown. */
                                _e( 'Week - List', 'piecal' ); 
                            ?>
                        </option>
                        <option value="dayGridWeek">
                            <?php 
                                /* Translators: String for Week - Classic view in view picker dropdown. */
                                _e( 'Week - Classic', 'piecal' ); 
                            ?>
                        </option>
                    </select>
                </label>
            </div>
            <div id="calendar"></div>
            <div 
                class="piecal-popover" 
                x-show="$store.calendarEngine.showPopover"
                style="display: none;">
                    <div 
                    class="piecal-popover__inner" 
                    @click.outside="$store.calendarEngine.showPopover = false"
                    x-trap.noscroll="$store.calendarEngine.showPopover">
                        <button 
                        class="piecal-popover__close-button" 
                        title="<?php
                        /* Translators: Label for close button in Pie Calendar popover. */
                        _e( 'Close event details', 'piecal' )
                        ?>"
                        @click="$store.calendarEngine.showPopover = false">
                        </button>
                        <p class="piecal-popover__title" x-text="$store.calendarEngine.eventTitle">Event Title</p>
                        <hr>
                        <div class="piecal-popover__meta">
                            <p>
                            <?php
                            /* Translators: Label for event start date in Pie Calendar popover. */
                            _e('Starts', 'piecal')
                            ?>
                            </p>
                            <p 
                            aria-labelledby="piecal-event-start-date" 
                            x-text="!$store.calendarEngine.eventAllDay ? new Date($store.calendarEngine.eventStart).toLocaleDateString( $store.calendarEngine.locale, $store.calendarEngine.localeDateStringFormat ) : new Date($store.calendarEngine.eventStart).toLocaleDateString( $store.calendarEngine.locale, $store.calendarEngine.allDayLocaleDateStringFormat )"></p>
                            <p x-show="$store.calendarEngine.eventEnd">
                            <?php
                            /* Translators: Label for event end date in Pie Calendar popover. */
                            _e('Ends', 'piecal')
                            ?>
                            </p>
                            <p 
                            x-show="$store.calendarEngine.eventEnd" 
                            x-text="!$store.calendarEngine.eventAllDay ? new Date($store.calendarEngine.eventEnd).toLocaleDateString( $store.calendarEngine.locale, $store.calendarEngine.localeDateStringFormat ) : new Date($store.calendarEngine.eventActualEnd).toLocaleDateString( $store.calendarEngine.locale, $store.calendarEngine.allDayLocaleDateStringFormat )"></p>
                            <?php do_action('piecal_popover_after_meta'); ?>
                        </div>
                        <hr>
                        <p class="piecal-popover__details" x-text="$store.calendarEngine.eventDetails"></p>
                        <a :href="$store.calendarEngine.eventUrl">
                        <?php
                        $filtered_popover_link = apply_filters( 'piecal_popover_link_text', null );

                        if( $filtered_popover_link == null ) {
                        /* Translators: Label for "View <Post Type>" in Pie Calendar popover. */
                            _e('View ', 'piecal');
                            ?>
                            <span x-text="$store.calendarEngine.eventType"></span>
                            <?php
                        } else {
                            echo $filtered_popover_link;
                        }
                        ?>
                        </a>
                        <?php
                        echo apply_filters('piecal_after_popover_link', null);
                        ?>
                    </div>
            </div>
        </div>
        <?php
        wp_reset_postdata();
        return ob_get_clean();
    }
}

if ( ! function_exists( 'piecal_replace_read_more' ) ) {
    function piecal_replace_read_more( $more ) {
        return '...';
    }
}

// Pie Calendar start & end date shortcode(s)
add_shortcode('piecal-info', 'render_piecal_info');

function render_piecal_info( $atts ) {

    if( !get_post_meta( get_the_ID(), '_piecal_is_event', true ) ) 
        return;

    /* Translators: This string is used to separate the date and time in the default format output by the piecal-info shortcode. Each letter must be escaped by a backslash. */
    $format = $atts['format'] ?? get_option('date_format') . __(' \a\t ', 'piecal') . get_option('time_format');
    $format_date_only = $atts['format'] ?? get_option('date_format');

    $start = get_post_meta( get_the_ID(), '_piecal_start_date', true ) ? date( $format, strtotime( get_post_meta( get_the_ID(), '_piecal_start_date', true ) ) ) : false;
    $start_date_only = get_post_meta( get_the_ID(), '_piecal_start_date', true ) ? date( $format_date_only, strtotime( get_post_meta( get_the_ID(), '_piecal_start_date', true ) ) ) : false;
    $end = get_post_meta( get_the_ID(), '_piecal_end_date', true ) ? date( $format, strtotime( get_post_meta( get_the_ID(), '_piecal_end_date', true ) ) ) : false;
    $end_date_only = get_post_meta( get_the_ID(), '_piecal_end_date', true ) ? date( $format_date_only, strtotime( get_post_meta( get_the_ID(), '_piecal_end_date', true ) ) ) : false;
    $allday = get_post_meta( get_the_ID(), '_piecal_is_allday', true ) ?? false;

    /* Translators: The 'Starts on' prepend text for the piecal-info shortcode */
    $start_prepend = apply_filters( 'piecal_info_start_prepend', __("Starts on", 'piecal') );

    /* Translators: This string is used for the start date/time output by the piecal-info shortcode. %1$s is the 'Starts on' prepend. %2$s is the start date & time. */
    $info_string_start = sprintf( esc_html__( '%1$s %2$s.', 'piecal' ), $start_prepend, $start );
    $info_string_start_date_only = sprintf( esc_html__( '%1$s %2$s.', 'piecal' ), $start_prepend, $start_date_only );

    /* Translators: The 'Ends on' prepend text for the piecal-info shortcode. */
    $end_prepend = apply_filters( 'piecal_info_end_prepend', __( "Ends on", 'piecal' ) );

    /* Translators: This string is used for the end date/time output by the piecal-info shortcode. Placeholder is the end date & time. */
    $info_string_end = sprintf( esc_html__( ' %1$s %2$s.', 'piecal' ), $end_prepend, $end );
    $info_string_end_date_only = sprintf( esc_html__( ' %1$s %2$s.', 'piecal' ), $end_prepend, $end_date_only );

    /* Translators: This string is output at the end of the start/end date/time output by the piecal-info shortcode if the event is marked as all day. */
    $info_string_allday = apply_filters( 'piecal_info_lasts_all_day', __( ' Lasts all day.', 'piecal' ) );

    // Start date only
    if( $start && !$end && !$allday ) {
        return $info_string_start;
    }

    // Start & end date, not all day
    if( $start && $end && !$allday ) {
        return $info_string_start . $info_string_end;
    }

    // Start & end date, all day
    if( $start && $end && $allday ) {
        return $info_string_start_date_only . $info_string_end_date_only . $info_string_allday;
    }

    // Start date only, all day
    if( $start && !$end && $allday ) {
        return $info_string_start_date_only . $info_string_allday;
    }

}