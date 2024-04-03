<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Basics extends Field
{

    const OBJECT_NAME = 'basics';

    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $fields = new FieldsBuilder('basics_data', [
            'title' => __('Basics data', 'basics'),
        ]);

        $fields
            ->setLocation('post_type', '==', self::OBJECT_NAME);

        $fields
            ->addTab('basics_info', [
                'label' => __('Basics info', 'basics'),
            ]);

        return $fields->build();
    }
}
