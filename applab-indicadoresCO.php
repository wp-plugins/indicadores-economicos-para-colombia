<?php
/*
Plugin Name: Indicadores Económicos - CO
Plugin URI: http://www.applab.in/
Description: Widget desarrollado para mostrar los indicadores económicos más importantes para Colombia
Version: 1.0
Author: AppLab - Laboratorio de Ideas
Author URI: http://www.applab.in/
*/

add_action( 'widgets_init', array( 'Widget_indicadoresEconomicosCO', 'register' ) );

register_activation_hook( __FILE__, array( 'Widget_indicadoresEconomicosCO', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Widget_indicadoresEconomicosCO', 'deactivate' ) );

class Widget_indicadoresEconomicosCO
{
    function activate() {
        $aData = array( 'WIDGET_NAME' => 'Indicadores Económicos',
                        'WIDGET_PADDING' => '0px' );

        if( ! get_option( 'indicadoresEconomicosCO' ) ) {
            add_option( 'indicadoresEconomicosCO' , $aData );
        }
        else {
            update_option( 'indicadoresEconomicosCO' , $data);
        }
    }

    function deactivate() {
        delete_option( 'indicadoresEconomicosCO' );
    }

    function control() {
        $aData = get_option( 'indicadoresEconomicosCO' );
        ?>
            <p>
                <label>Título:</label>
                <input name="indicadoresEconomicosCO_WIDGET_NAME" type="text" value="<?php echo $aData['WIDGET_NAME']; ?>" size="30" />
            </p>
            <p>
                <label>Margen Interno:</label>
                <select name="indicadoresEconomicosCO_WIDGET_PADDING">
                    <option value="0px"<?php if ($aData['WIDGET_PADDING']=='0px') {echo ' selected="selected"';} else {echo '';}?>>0</option>
                    <option value="5px"<?php if ($aData['WIDGET_PADDING']=='5px') {echo ' selected="selected"';} else {echo '';}?>>5</option>
                    <option value="10px"<?php if ($aData['WIDGET_PADDING']=='10px') {echo ' selected="selected"';} else {echo '';}?>>10</option>
                    <option value="15px"<?php if ($aData['WIDGET_PADDING']=='15px') {echo ' selected="selected"';} else {echo '';}?>>15</option>
                    <option value="20px"<?php if ($aData['WIDGET_PADDING']=='20px') {echo ' selected="selected"';} else {echo '';}?>>20</option>
                </select>
            </p>
        <?php
        if( isset( $_POST['indicadoresEconomicosCO_WIDGET_NAME'] ) )
        {
            $aData['WIDGET_NAME'] = esc_attr( $_POST['indicadoresEconomicosCO_WIDGET_NAME'] );
            $aData['WIDGET_PADDING'] = esc_attr( $_POST['indicadoresEconomicosCO_WIDGET_PADDING'] );

            update_option( 'indicadoresEconomicosCO', $aData );
        }
    }

    function widget($args) {
        $aData = get_option( 'indicadoresEconomicosCO' );
        
        echo $args['before_widget'];
        echo $args['before_title'] . $aData['WIDGET_NAME'] . $args['after_title'];
        ?>
        <!-- Indicadores Económicos -->
        <div id="bgBody" style="padding: <?php echo $aData['WIDGET_PADDING']; ?>">
        <a id="bgLink" href="http://www.applab.in/" target="_blank">Integrado por AppLab.in</a>
        <script type="text/javascript">
        <!--
        var bgHost = "http://www.applab.in/";
        var bgType = "BG-19284-1";
        (function(d){
        var f = bgHost+ "indicators.php?bgvalue="+bgType+ ","+d.getElementById('bgLink').href+ ","+d.getElementById('bgLink').innerHTML;
        var g = d.write(unescape("%3Cscript src='"+f+"' type='text/javascript'%3E%3C/script%3E"));
        })(document);
        //-->
        </script> 
        </div> 
        <!-- Indicadores Económicos -->
        <?php
        echo $args['after_widget'];
    }
    function register() {
        
        wp_register_sidebar_widget( '1','Indicadores Económicos - CO', array( 'Widget_indicadoresEconomicosCO', 'widget' ), array('description' => 'Widget desarrollado para mostrar los indicadores económicos de Colombia'));
        wp_register_widget_control( '1','Indicadores Económicos - CO', array( 'Widget_indicadoresEconomicosCO', 'control' ));
        
    }
}

?>