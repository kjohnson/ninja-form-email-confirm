<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_EmailConfirm_Field
 */
class NF_EmailConfirm_Field extends NF_Fields_Textbox
{
    protected $_name = 'emailconfirm';

    protected $_type = 'emailconfirm';

    protected $_nicename = 'Email Confirm';

    protected $_section = 'userinfo';

    protected $_icon = 'envelope-o';

    protected $_error_message = '';

    protected $_settings = array( 'confirm_field' );

    public function __construct()
    {
        parent::__construct();

        $this->_nicename = __( 'Email Confirm', 'ninja-forms' );

        $this->_settings[ 'confirm_field' ][ 'value' ] = __( 'email', 'ninja-forms' );
        $this->_settings[ 'confirm_field' ][ 'field_types' ] = array( 'email' );
        $this->_settings[ 'confirm_field' ][ 'field_value_format' ] = 'key';
        $this->_settings[ 'confirm_field' ][ 'group' ] = 'primary';

        add_filter( 'nf_sub_hidden_field_types', array( $this, 'hide_field_type' ) );
    }

    public function validate( $field, $data )
    {
        $errors = parent::validate( $field, $data );

        $email_fields = $this->get_email_fields( $data );

        if( ! is_array( $email_fields ) || empty( $email_fields ) ) return $errors;

        foreach( $email_fields as $email_field ){

            if( $this->is_matching_values( $field, $email_field ) ) continue;

            $errors[] = $this->get_error_message();
        }

        return $errors;
    }

    private function get_email_fields( $data )
    {
        $email_fields = array();

        foreach( $data[ 'fields' ] as $field ){

            if( 'email' != $field[ 'type' ] ) continue;

            $email_fields[] = $field;
        }

        return $email_fields;
    }

    private function is_matching_values( $a, $b )
    {
        return $a[ 'value' ] === $b[ 'value' ];
    }

    private function get_error_message()
    {
        if( $this->_error_message ) return $this->_error_message;

        $error_message = __( 'Emails do not match', 'ninja-forms-email-confirm-field' );

        return $this->_error_message = $error_message;
    }

    public function hide_field_type( $field_types )
    {
        $field_types[] = $this->_name;

        return $field_types;
    }
}
