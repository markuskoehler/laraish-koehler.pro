<?php

namespace App\Providers;

use Laraish\WpSupport\Providers\ThemeOptionsProvider as ServiceProvider;
use Laraish\Options\OptionsPage;

class ThemeOptionsProvider extends ServiceProvider
{
    public function boot()
    {
	    $optionsPage = new OptionsPage([
		    'menuSlug'    => 'my_options_page',
		    'menuTitle'   => 'My Options Page',
		    'pageTitle'   => 'My Options Page',
		    'iconUrl'     => 'dashicons-welcome-learn-more',
		    'optionGroup' => 'my_options_page',
		    'optionName'  => 'my_options',
		    'capability'  => 'manage_categories',
		    'sections'    => [
			    [
				    'id'          => 'section-id',
				    'title'       => 'Section title',
				    'description' => 'Section Description',
				    'fields'      => [
					    [
						    'id'          => 'my-avatar',
						    'type'        => 'media',
						    'title'       => 'Avatar',
						    'description' => 'Choose an image for your avatar.'
					    ],
					    [
						    'id'    => 'my-email',
						    'type'  => 'email',
						    'title' => 'E-mail',
					    ],
					    [
						    'id'         => 'my-nice-name',
						    'type'       => 'text',
						    'title'      => 'Nice name',
						    'attributes' => [
							    'placeholder' => 'your nice name',
							    'maxlength'   => 10,
							    'class'       => 'regular-text'
						    ],
					    ],
					    [
						    'id'    => 'my-description',
						    'type'  => 'textarea',
						    'title' => 'About Me',
					    ],
				    ]
			    ]
		    ],
		    'helpTabs'    => [
			    [
				    'title'    => 'tab-1',
				    'content'  => '<p>description here</p>',
			    ],
			    [
				    'title'    => 'tab-2',
				    'content'  => '<p>description here</p>',
			    ]
		    ],
		    'scripts'     => ['https://unpkg.com/vue/dist/vue.js'],
		    'styles'      => ['/my-css.css'],
	    ]);

	    $optionsPage->register();

        parent::boot();
    }
}
