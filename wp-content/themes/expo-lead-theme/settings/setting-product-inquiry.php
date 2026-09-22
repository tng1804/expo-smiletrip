<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the ACF fields used by Expo lead records.
 */
function expo_lead_register_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key' => 'group_expo_lead_details',
			'title' => __( 'Lead information', 'expo-lead' ),
			'fields' => array(
				array(
					'key' => 'field_expo_lead_email',
					'label' => __( 'Email', 'expo-lead' ),
					'name' => 'expo_lead_email',
					'type' => 'email',
					'required' => 1,
					'show_column' => 1,
					'wrapper' => array( 'width' => '33' ),
				),
				array(
					'key' => 'field_expo_lead_phone',
					'label' => __( 'Phone', 'expo-lead' ),
					'name' => 'expo_lead_phone',
					'type' => 'text',
					'required' => 1,
					'show_column' => 1,
					'wrapper' => array( 'width' => '33' ),
				),
				array(
					'key' => 'field_expo_lead_service',
					'label' => __( 'Service', 'expo-lead' ),
					'name' => 'expo_lead_service',
					'type' => 'text',
					'required' => 1,
					'show_column' => 1,
					'wrapper' => array( 'width' => '34' ),
				),
				array(
					'key' => 'field_expo_lead_message',
					'label' => __( 'Message', 'expo-lead' ),
					'name' => 'expo_lead_message',
					'type' => 'textarea',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'expo_lead',
					),
				),
			),
		)
	);
}
add_action( 'acf/init', 'expo_lead_register_acf_fields' );
