<?php

	class WPO_Shortcode_Content extends WPO_Shortcode_Base{

		public function __construct( ){
			// add hook to convert shortcode to html.
			$this->name = str_replace( 'wpo_shortcode_','',strtolower( __CLASS__ ) );
			$this->key = 'wpo_'.$this->name;

			add_shortcode( $this->key  ,  array($this,'render') );

			parent::__construct( );
		}

		/**
		 * $data format is object field of megamenu_widget record.
		 */
		public function getButton( $data=null ){
			$button = array(
				'icon'	 => 'content',
				'title' => $this->l( 'Text Content' ),
				'desc'  => $this->l( 'Supported with WYSWYG Editor' ),
				'name'  => $this->name
			);
			return $button;
		}

		public function getOptions( ){
		    $this->options[] = array(
		        'label' 	=> __('Content', 'unity'),
		        'id' 		=> 'content',
		        'type' 		=> 'textarea',
		        'explain'	=> __( 'Put Content Here', 'unity' ),
		        'default'	=> '',
		        'hint'		=> '',
	        );

	         $this->options[] = array(
		        'label' 	=> __('Addition Class', 'unity'),
		        'id' 		=> 'class',
		        'type' 		=> 'input',
		        'explain'	=> __( 'Using to make own style', 'unity' ),
		        'default'	=> '',
		        'hint'		=> '',
	        );
		}
	}
?>