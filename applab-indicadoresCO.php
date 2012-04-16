<?php
/*
Plugin Name: Indicadores Económicos - Colombia
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
                        'WIDGET_WIDTH' => '100' );

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
                <label>Ancho en porcentaje:</label>
                <input name="indicadoresEconomicosCO_WIDGET_WIDTH" type="text" value="<?php echo $aData['WIDGET_WIDTH']; ?>" />%
            </p>
        <?php
        if( isset( $_POST['indicadoresEconomicosCO_WIDGET_NAME'] ) )
        {
            $aData['WIDGET_NAME'] = esc_attr( $_POST['indicadoresEconomicosCO_WIDGET_NAME'] );
            $aData['WIDGET_WIDTH'] = esc_attr( $_POST['indicadoresEconomicosCO_WIDGET_WIDTH'] );

            update_option( 'indicadoresEconomicosCO', $aData );
        }
    }

    function widget($args) {
        $aData = get_option( 'indicadoresEconomicosCO' );
        
        echo $args['before_widget'];
        echo $args['before_title'] . $aData['WIDGET_NAME'] . $args['after_title'];
        echo '<style type="text/css">
              ul#bgList {width:'.$aData['WIDGET_WIDTH'].'%;}
              </style>';
        ?>
        <!-- Indicadores Económicos -->
        <div id="bgBody">
         <a id="bgLink" href="http://www.applab.in/" target="_blank">Integrado por AppLab.in</a>
         <script type="text/javascript">
          // <![CDATA[
          var bgHost = "http://www.applab.in/";
          var bgType = "CO-19284-1";
          var bgIndi = "9|1|2|10|6|4|7|3";
          (function(d){ var f = bgHost+ "apps/indicators/"+bgType+"/"+bgIndi+"/functions.js"; d.write(unescape("%3Cscript src='"+f+"' type='text/javascript'%3E%3C/script%3E")); })(document);
          // ]]>
         </script>
        </div> 
        <!-- Indicadores Económicos -->
        <?php
        echo $args['after_widget'];
    }
    function register() {
        
        wp_register_sidebar_widget( '1','Indicadores Económicos - Colombia', array( 'Widget_indicadoresEconomicosCO', 'widget' ), array('description' => 'Widget desarrollado para mostrar los indicadores economicos de Colombia'));
        wp_register_widget_control( '1','Indicadores Económicos - Colombia', array( 'Widget_indicadoresEconomicosCO', 'control' ));
        
    }
}
?>