<?php
/**
 * Plugin Name: TelecomsXChange
 * Plugin URI: https://github.com/telecomsxchange/Wordpress-plugin
 * Description: TelecomsXChange plugin connects your Wordpress site to over 300 Telecom carriers and VoIP providers around the world. allows you to create a Click2Call button or a Verify button that will connect your website visitors to your call center instantly so you never miss a lead again.
 * Version: 1.3
 * Author: TelecomsXChange
 * Author URI: www.telecomsxchange.com/wordpress
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
add_action( 'plugins_loaded', 'tcxc_load' );
function tcxc_load()
{
    if ( is_admin() ) {
        add_action( 'admin_init', 'tcxc_settings' , 1000 );
        add_action( 'admin_menu', 'tcxc_menu', 1000 );
    }
}
function tcxc_settings()
{
    register_setting( "TelecomsXChange-Settings", "tcxc");
}
function tcxc_menu()
{
    add_options_page( 'TelecomsXChange', 'TelecomsXChange', 'administrator', 'TelecomsXChange-Settings', 'tcxc_settings_page' );
}
function tcxc_settings_page()
{
   $options = get_option( "tcxc");
    ?>
    <div class="wrap">
        <div id="icon-options-general" class="icon32"></div><h2>TelecomsXChange for Wordpress</h2>
        <form method="post" action="options.php">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Buyer Login<br /><span style="font-size: x-small;"></span></th>
                    <td>
                        <input size="50" type="text" name="tcxc[login]" placeholder="Your Buyer's name" value="<?php echo htmlspecialchars( $options['login'] ); ?>" class="regular-text" />
                        <br />
                        <small>(TelecomsXChange) Buyer login, Dont have one ? Get it here www.telecomsxchange.com/wordpress/</small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">API Key<br /><span style="font-size: x-small;"></span></th>
                    <td>
                        <input size="50" type="text" name="tcxc[api_key]" placeholder="Your API Key" value="<?php echo htmlspecialchars( $options['api_key'] ); ?>" class="regular-text" />
                        <br />
                        <small>(TelecomsXChange) API key, Generated from Buyer Portal, Preferences Page</small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">i_account<br /><span style="font-size: x-small;"></span></th>
                    <td>
                        <input size="50" type="text" name="tcxc[i_account]" placeholder="Your i_account" value="<?php echo htmlspecialchars( $options['i_account'] ); ?>" class="regular-text" />
                        <br />
                        <small>i_account that you want to use for Callback billing</small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Phone Number<br /><span style="font-size: x-small;"></span></th>
                    <td>
                        <input size="50" type="text" name="tcxc[cld1]" placeholder="Your Phone Number" value="<?php echo htmlspecialchars( $options['cld1'] ); ?>" class="regular-text" />
                        <br />
                        <small>The phone number of your company</small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Caller ID<br /><span style="font-size: x-small;"></span></th>
                    <td>
                        <input size="50" type="text" name="tcxc[cli2]" placeholder="Your caller ID" value="<?php echo htmlspecialchars( $options['cli2'] ); ?>" class="regular-text" />
                        <br />
                        <small>The phone number that will appear to the user</small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Carrier ID 1<br /><span style="font-size: x-small;"></span></th>
                    <td>
                        <input size="50" type="text" name="tcxc[car1]" placeholder="first carrier" value="<?php echo htmlspecialchars( $options['car1'] ); ?>" class="regular-text" />
                        <br />
                        <small>The Carrier that will be used for the first called e.g 220 is TATA Communications Carrier ID</small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Carrier ID 1<br /><span style="font-size: x-small;"></span></th>
                    <td>
                        <input size="50" type="text" name="tcxc[car2]" placeholder="second carrier" value="<?php echo htmlspecialchars( $options['car2'] ); ?>" class="regular-text" />
                        <br />
                        <small>The Carier that will be used for the second call e.g 220 is TATA Communications Carrier ID</small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Call Confirmation Message<br /><span style="font-size: x-small;"></span></th>
                    <td>
                        <input size="50" type="text" name="tcxc[call_confirm]" placeholder="We will call you shortly!" value="<?php echo htmlspecialchars( $options['call_confirm'] ); ?>" class="regular-text" />
                        <br />
                        <small>This message will displayed after a user requests a call.</small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Powered By text<br /><span style="font-size: x-small;"></span></th>
                    <td>
                        <input size="50" type="text" name="tcxc[poweredby]" placeholder="Powered By: TelecomsXChange!" value="<?php echo htmlspecialchars( $options['poweredby'] ); ?>" class="regular-text" />
                        <br />
                        <small>Powered by text inside the confirmation message.</small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Time to wait<br /><span style="font-size: x-small;"></span></th>
                    <td>
                        <input size="50" type="text" name="tcxc[lock_time]" placeholder="60" value="<?php echo htmlspecialchars( $options['lock_time'] ); ?>" class="regular-text" />
                        <br />
                        <small>Time in Minutes before the user can request another call.</small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Time Limit Message<br /><span style="font-size: x-small;"></span></th>
                    <td>
                        <input size="50" type="text" name="tcxc[error_msg]" placeholder="Error message" value="<?php echo htmlspecialchars( $options['error_msg'] ); ?>" class="regular-text" />
                        <br />
                        <small>you can use <strong>[number]</strong> variable to display your company's number above.</small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">phone number placeholder<br /><span style="font-size: x-small;"></span></th>
                    <td>
                        <input size="50" type="text" name="tcxc[input_placeholder]" placeholder="" value="<?php echo htmlspecialchars( $options['input_placeholder'] ); ?>" class="regular-text" />
                        <br />
                        <small>The placeholder of the input phone number i.e. "enter your phone"</small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Button Text<br /><span style="font-size: x-small;"></span></th>
                    <td>
                        <input size="50" type="text" name="tcxc[btn_text]" placeholder="Request a Call" value="<?php echo htmlspecialchars( $options['btn_text'] ); ?>" class="regular-text" />
                        <br />
                        <small>The text that is displayed on the button</small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">custom button style<br /><span style="font-size: x-small;"></span></th>
                    <td>
                        <textarea size="50" type="text" name="tcxc[btn_css]" class="regular-text"  ><?php echo htmlspecialchars( $options['btn_css'] ); ?></textarea>
                        <br />
                        <small>CSS code</small>
                    </td>
                </tr>

            </table>
            <?php settings_fields( 'TelecomsXChange-Settings' ); ?>
            <input type="submit" class="button-primary" value="Save" />
        </form>
        <form method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>">
            <h2>After saving the above settings, you can test the service here</h2>
            <input type="hidden" name="action" value="test_tcxc">
            <?php
            $redirect = urlencode( $_SERVER['REQUEST_URI'] );
            ?>
            <label>Your number here:</label>
            <input type="text" name="tcxc_number" placeholder="21234567890">
            <input type="hidden" name="_wp_http_referer" value="<?php echo $redirect; ?>">
            <?php submit_button( 'Test' ); ?>
        </form>
    </div>
    <?php
}
function tcxc_makeTheCall($c)
{
    $options= get_option('tcxc');
    $cld1=$options['cld1'];
    $cli2=$options['cli2'];
    $cld2=$c;
    $cli1=$c;
    $login=$options['login'];
    $i_account=$options['i_account'];
    $i_connection1=$options['car1'];
    $i_connection2=$options['car2'];
    $api_key = $options['api_key'];
    $ts = time();
    $tcxc_host = "https://members.telecomsxchange.com";
    $check_uri = "/api/callback/initiate/$login/$i_account/$cld1/$cli1/$i_connection1/$cld2/$cli2/$i_connection2/$ts/";
    $sign = hash('sha256',$check_uri . $api_key);
    $body = wp_remote_retrieve_body( wp_remote_get( $tcxc_host . $check_uri . $sign , array('redirection'=>0)));
    return $body;
}
add_action( 'admin_post_test_tcxc', 'tcxc_test' );

function tcxc_test() {
    $url = add_query_arg( 'msg', "", urldecode( $_POST['_wp_http_referer'] ) );
    $number=$_POST['tcxc_number'];
    add_filter( 'redirect_post_location',  'tcxc_add_notice_query_var', 99 );
    $o=tcxc_makeTheCall($number);
    wp_safe_redirect( $url );
    exit;
}
add_action( 'admin_notices', 'tcxc_admin_notices' );
 function tcxc_admin_notices() {
    if ( ! isset( $_GET['msg'] ) ) {
        return;
    }
    ?>
    <div class="updated">
        <p>if everything is correct, you should receive a call!</p>
    </div>
    <?php
}
function tcxc_add_notice_query_var( $location ) {
    remove_filter( 'redirect_post_location', 'tcxc_add_notice_query_var', 99 );
    return add_query_arg( array( 'msg' => 'ID' ), $location );
}
add_shortcode('tcxc-button', 'tcxc_display_button');
function tcxc_display_button()
{
    $option = get_option("tcxc");
    wp_enqueue_script(
        'wptcxc',
        plugin_dir_url( __FILE__ ) . 'js/plugin.js',
        array('jquery'),
        false,
        true
    );
    wp_localize_script(
        'wptcxc',
        'wptcxc_object',
        array(
            'ajax_url'  => admin_url( 'admin-ajax.php' ),
            'nonce'  => wp_create_nonce( 'wptcxc-nonce' ),
            'call_confirm'=>empty($option['call_confirm'])?"We will call you shortly!":$option['call_confirm'],
            'poweredby'=>empty($option['poweredby'])?"Powered by: TelecomsXChange":$option['poweredby'],
            'error_msg'=>empty($option['error_msg'])?"You have exceeded max number of callback requests today, Call {$option['cli2']} for further assistance.":str_replace("[number]",$option['cli2'],$option['error_msg']),
        )
    );
    ob_start();
    echo '<div class="callme-wrapper">';
    echo '<div class="callme-slider" style="max-width:300px;display: none;"><input type="text" class="number-input" placeholder="'.$option['input_placeholder'].'"  name="r_number" /><span class="call-msg"></span></div>';
    echo '<input type="button" class="call_btn" value="';
    echo empty($option['btn_text'])?"Call Me":$option['btn_text'];
    echo '" />';
    echo '</div>';
    echo '<style>';
    echo !empty($option['btn_css'])?$option['btn_css']:"";
    echo '
    .call_btn {
    display: inline-block;
    font-size: 18px;
    font-weight: normal;
    text-align: center;
    border: none;
    padding: 12px 0 8px;
    margin: 2px;
    line-height: 1.7;
    position: relative;
    color: #FFF !important;
    background: #85b558 !important;";
    }';
    echo '</style>';

    $html = ob_get_contents();
    ob_end_clean();
    return $html;
}
add_action( 'wp_ajax_nopriv_ajax_request_call', 'tcxc_process_call_request' );
add_action( 'wp_ajax_ajax_request_call', 'tcxc_process_call_request' );  // For logged in users.
function tcxc_process_call_request() {
    check_ajax_referer( 'wptcxc-nonce', 'nonce' );  // This function will die if nonce is not correct.
    $number = sanitize_text_field($_POST['number']);
    if(tcxc_isLocked())
    {
        wp_send_json_error();
    }
    else{
        tcxc_incrementUses();
        $o=tcxc_makeTheCall($number);
        wp_send_json($o);
    }
    wp_die();
}

add_action(str_replace( ABSPATH . 'wp-content/plugins' . "/", "activate_", __FILE__), 'tcxc_db_install');
function tcxc_db_install()
{
    global $wpdb;
    if( $wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}tcxc_uses'") != "tcxc_uses" ) {
        $sql = "CREATE TABLE {$wpdb->prefix}tcxc_uses (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`request_date` datetime NOT NULL default '0000-00-00 00:00:00',
			`user_IP` varchar(100) NOT NULL default '',
			PRIMARY KEY  (`id`)
			);";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    $option['call_confirm']='We will call you shortly!';
    $option['poweredby']='Powered by: TelecomsXchange';
    $option['lock_time']='60';
    $option['error_msg']='You have exceeded max number of callback requests today, Call [number] for further assistance.';
    $option['btn_text']='Call me now';
    $option['input_placeholder']='44791234567';
    update_option('tcxc',$option);
}
function tcxc_incrementUses() {
    global $wpdb;
    $ip = $_SERVER['REMOTE_ADDR'];
    $q = "INSERT INTO {$wpdb->prefix}tcxc_uses (request_date, user_IP) " .
        "VALUES ( now(), '%s')";
    $q = $wpdb->prepare( $q, $ip );
    $wpdb->query($q);
}
function tcxc_isLocked() {
    global $wpdb;
    $ip = $_SERVER['REMOTE_ADDR'];
    $option = get_option('tcxc');
    $amount = $option['lock_time'];
    if(!isset($amount) || empty($amount) || is_null($amount))
        $amount=0;
    $amount *= 60;
    $q = "SELECT user_IP FROM {$wpdb->prefix}tcxc_uses " .
        "WHERE now() - request_date < $amount AND " .
        "user_IP LIKE %s";
    $q = $wpdb->prepare($q,$ip);
    $l = $wpdb->get_var($q);
    return $l;
}