<?php

if (class_exists('STM_LMS_Course')):
	wp_enqueue_script('vue-resource.js');
	stm_module_styles('vue-autocomplete', 'vue2-autocomplete');
	stm_module_scripts('vue-autocomplete', 'vue2-autocomplete', array());
	stm_module_scripts('courses_search', 'courses_search');
	?>

    <script>
        var stm_lms_search_value = '<?php echo (!empty($_GET['search'])) ? sanitize_text_field($_GET['search']) : ''; ?>';
    </script>

    <div class="stm_lms_courses_search vue_is_disabled" id="stm_lms_courses_search" v-bind:class="{'is_vue_loaded' : vue_loaded}">
        {{ search }}
        <a v-bind:href="'<?php echo esc_url(STM_LMS_Course::courses_page_url()) ?>?search=' + url"
           class="stm_lms_courses_search__button sbc">
            <i class="lnr lnr-magnifier"></i>
        </a>
        <form autocomplete="off">
            <autocomplete
                    name="search"
                    placeholder="<?php esc_attr_e('Search courses', 'masterstudy'); ?>"
                    url="<?php echo esc_url(rest_url('stm-lms/v1/courses', 'json')) ?>"
                    param="search"
                    anchor="value"
                    label="label"
                    id="search-courses-input"
                    :on-select="searchCourse"
                    :on-input="searching"
                    :on-ajax-loaded="loaded"
                    :debounce="1000"
                    model="search">
            </autocomplete>
        </form>
    </div>

<?php endif;