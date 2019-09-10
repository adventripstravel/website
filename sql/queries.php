<?php

// --------------------------------------------------------------------------- //
// Get's
// --------------------------------------------------------------------------- //

// Basic
public function get($id = '*', $fields = '*')
{
    if ($id == '*')
    {
        $condition = [
            'ORDER' => [
                'name' => 'ASC'
            ]
        ];
    }
    else
    {
        $condition = [
            'id_table' => $id
        ];
    }

    $query = $this->database->select('table', $fields, $condition);

    if ($id == '*')
        return Functions::get_decoded_query($query);
    else
        return !empty($query) ? Functions::get_decoded_query($query[0]) : null;
}

// Relational
public function get($id = '*', $fields = '*')
{
    if ($id == '*')
    {
        $condition = [
            'ORDER' => [
                'table.name' => 'ASC'
            ]
        ];
    }
    else
    {
        $condition = [
            'table.id_table' => $id
        ];
    }

    if ($fields == '*')
    {
        $fields = [
            'table.param',
        ];
    }
    else
    {
        foreach ($fields as $key => $value)
        {
            $explode = explode('.', $value);

            if (count($explode) == 3)
                $fields[$key] = $explode[0] . '.' . $explode[1] . ' (' . $explode[2] . ')';
            else
                $fields[$key] = 'table.' . $value;
        }
    }

    $query = $this->database->select('table', [
        '[>]relational_table' => [
            'id_relational_table' => 'id_table'
        ]
    ], $fields, $condition);

    if ($id == '*')
        return Functions::get_decoded_query($query);
    else
        return !empty($query) ? Functions::get_decoded_query($query[0]) : null;
}

// Multiple tables
public function get($id = '*', $fields = '*', $table = 'main_table')
{
    if ($table == 'main_table')
    {
        // ...
    }
    else if ($table == 'other_table')
    {
        // ...
    }

    if ($id == '*')
        return Functions::get_decoded_query($query);
    else
        return !empty($query) ? Functions::get_decoded_query($query[0]) : null;
}

// --------------------------------------------------------------------------- //
// Create's
// --------------------------------------------------------------------------- //

// Basic
public function new($data)
{
    $query = $this->database->insert('table', [
        'field' => $data['field'],
    ]);

    if (!empty($query))
        $query = $this->database->id($query);

    return $query;
}

// Basic with priority
public function new($data)
{
    $query = $this->database->insert('table', [
        'field' => $data['field'],
    ]);

    if (!empty($query))
    {
        $query = $this->database->id($query);

        if (!empty($data['priority']))
        {
            $this->database->update('table', [
                'priority' => null
            ], [
                'AND' => [
                    'id_table[!]' => $query,
                    'priority' => $data['priority']
                ]
            ]);
        }
    }

    return $query;
}

// Obligatory cover
public function new($data)
{
    $query = null;

    $data['cover'] = Functions::uploader($data['cover'], PATH_UPLOADS, ['png','jpg','jpeg'], 'unlimited');

    if (!empty($data['cover']))
    {
        $query = $this->database->insert('table', [
            'field' => $data['field'],
        ]);

        if (!empty($query))
            $query = $this->database->id($query);
    }

    return $query;
}

// Obligatory cover with priority
public function new($data)
{
    $query = null;

    $data['cover'] = Functions::uploader($data['cover'], PATH_UPLOADS, ['png','jpg','jpeg'], 'unlimited');

    if (!empty($data['cover']))
    {
        $query = $this->database->insert('table', [
            'field' => $data['field'],
        ]);

        if (!empty($query))
        {
            $query = $this->database->id($query);

            if (!empty($data['priority']))
            {
                $this->database->update('table', [
                    'priority' => null
                ], [
                    'AND' => [
                        'id_table[!]' => $query,
                        'priority' => $data['priority']
                    ]
                ]);
            }
        }
    }

    return $query;
}

// Optional cover
public function new($data)
{
    $query = null;

    $go = true;

    if (!empty($data['cover']))
    {
        $data['cover'] = Functions::uploader($data['cover'], PATH_UPLOADS, ['png','jpg','jpeg'], 'unlimited');
        $go = !empty($data['cover']) ? true : false;
    }

    if ($go == true)
    {
        $query = $this->database->insert('table', [
            'field' => $data['field'],
        ]);

        if (!empty($query))
            $query = $this->database->id($query);
    }

    return $query;
}

// Optional cover with priority
public function new($data)
{
    $query = null;

    $go = true;

    if (!empty($data['cover']))
    {
        $data['cover'] = Functions::uploader($data['cover'], PATH_UPLOADS, ['png','jpg','jpeg'], 'unlimited');
        $go = !empty($data['cover']) ? true : false;
    }

    if ($go == true)
    {
        $query = $this->database->insert('table', [
            'field' => $data['field'],
        ]);

        if (!empty($query))
        {
            $query = $this->database->id($query);

            if (!empty($data['priority']))
            {
                $this->database->update('table', [
                    'priority' => null
                ], [
                    'AND' => [
                        'id_table[!]' => $query,
                        'priority' => $data['priority']
                    ]
                ]);
            }
        }
    }

    return $query;
}

// Multiple tables
public function new($data, $table = 'main_table')
{
    if ($table == 'main_table')
    {
        // ...
    }
    else if ($table == 'other_table')
    {
        // ...
    }

    return $query;
}

// --------------------------------------------------------------------------- //
// Edit's
// --------------------------------------------------------------------------- //

// Basic
public function edit($data)
{
    $query = $this->database->update('table', [
        'field' => $data['field'],
    ], [
        'id_table' => $data['id_table']
    ]);

    return $query;
}

// Basic with priority
public function edit($data)
{
    $query = null;

    $edited = $this->get($data['id_table'], ['priority']);

    if (!empty($edited))
    {
        $query = $this->database->update('table', [
            'field' => $data['field'],
        ], [
            'id_table' => $data['id_table']
        ]);

        if (!empty($query) AND $data['priority'] != $edited['priority'])
        {
            $this->database->update('table', [
                'priority' => null
            ], [
                'AND' => [
                    'id_table[!]' => $data['id_table'],
                    'priority' => $data['priority']
                ]
            ]);
        }
    }

    return $query;
}

// Obligatory cover
public function edit($data)
{
    $query = null;

    $edited = $this->get($data['id_table'], ['cover']);

    if (!empty($edited))
    {
        $data['cover'] = !empty($data['cover']) ? Functions::uploader($data['cover'], PATH_UPLOADS, ['png','jpg','jpeg'], 'unlimited') : $edited['cover'];

        if (!empty($data['cover']))
        {
            $query = $this->database->update('table', [
                'field' => $data['field'],
            ], [
                'id_table' => $data['id_table']
            ]);

            if (!empty($query) AND $data['cover'] != $edited['cover'])
                Functions::undoloader($edited['cover'], PATH_UPLOADS);
        }
    }

    return $query;
}

// Obligatory cover with priority
public function edit($data)
{
    $query = null;

    $edited = $this->get($data['id_table'], ['cover','priority']);

    if (!empty($edited))
    {
        $data['cover'] = !empty($data['cover']) ? Functions::uploader($data['cover'], PATH_UPLOADS, ['png','jpg','jpeg'], 'unlimited') : $edited['cover'];

        if (!empty($data['cover']))
        {
            $query = $this->database->update('table', [
                'field' => $data['field'],
            ], [
                'id_table' => $data['id_table']
            ]);

            if (!empty($query))
            {
                if ($data['cover'] != $edited['cover'])
                    Functions::undoloader($edited['cover'], PATH_UPLOADS);

                if ($data['priority'] != $edited['priority'])
                {
                    $this->database->update('table', [
                        'priority' => null
                    ], [
                        'AND' => [
                            'id_table[!]' => $data['id_table'],
                            'priority' => $data['priority']
                        ]
                    ]);
                }
            }
        }
    }

    return $query;
}

// Optional cover
public function edit($data)
{
    $query = null;

    $edited = $this->get($data['id_table'], ['cover']);

    if (!empty($edited))
    {
        $go = true;

        if (!empty($data['cover']))
        {
            $data['cover'] = Functions::uploader($data['cover'], PATH_UPLOADS, ['png','jpg','jpeg'], 'unlimited');
            $go = !empty($data['cover']) ? true : false;
        }
        else
            $data['cover'] = $edited['cover'];

        if ($go == true)
        {
            $query = $this->database->update('table', [
                'field' => $data['field'],
            ], [
                'id_table' => $data['id_table']
            ]);

            if (!empty($query) AND $data['cover'] != $edited['cover'])
                Functions::undoloader($edited['cover'], PATH_UPLOADS);
        }
    }

    return $query;
}

// Optional cover with priority
public function edit($data)
{
    $query = null;

    $edited = $this->get($data['id_table'], ['cover']);

    if (!empty($edited))
    {
        $go = true;

        if (!empty($data['cover']))
        {
            $data['cover'] = Functions::uploader($data['cover'], PATH_UPLOADS, ['png','jpg','jpeg'], 'unlimited');
            $go = !empty($data['cover']) ? true : false;
        }
        else
            $data['cover'] = $edited['cover'];

        if ($go == true)
        {
            $query = $this->database->update('table', [
                'field' => $data['field'],
            ], [
                'id_table' => $data['id_table']
            ]);

            if (!empty($query))
            {
                if ($data['cover'] != $edited['cover'])
                    Functions::undoloader($edited['cover'], PATH_UPLOADS);

                if ($data['priority'] != $edited['priority'])
                {
                    $this->database->update('table', [
                        'priority' => null
                    ], [
                        'AND' => [
                            'id_table[!]' => $data['id_table'],
                            'priority' => $data['priority']
                        ]
                    ]);
                }
            }
        }
    }

    return $query;
}

// Multiple tables
public function edit($data, $table = 'main_table')
{
    if ($table == 'main_table')
    {
        // ...
    }
    else if ($table == 'other_table')
    {
        // ...
    }

    return $query;
}

// --------------------------------------------------------------------------- //
// Delete's
// --------------------------------------------------------------------------- //

// Basic
public function delete($id)
{
    $query = $this->database->delete('table', [
        'id_table' => $id
    ]);

    return $query;
}

// Cover or Gallery
public function delete($id)
{
    $query = null;

    $deleted = $this->get($id, ['cover','gallery']);

    if (!empty($deleted))
    {
        $query = $this->database->delete('table', [
            'id_table' => $id
        ]);

        if (!empty($query))
        {
            Functions::undoloader($deleted['cover'], PATH_UPLOADS);
            Functions::undoloader($deleted['gallery'], PATH_UPLOADS);
        }
    }

    return $query;
}

// --------------------------------------------------------------------------- //
// Others
// --------------------------------------------------------------------------- //

// Restores default values of settings table
public function settings()
{
    $this->database->update('settings', [
        'logotypes' => json_encode([
            'color' => 'logotype_color.png',
            'black' => 'logotype_black.png',
            'white' => 'logotype_white.png'
        ]),
        'covers' => json_encode([
            'home' => 'home.png',
            'products' => 'products.png',
            'blog' => 'blog.png',
            'about' => 'about.png',
            'contact' => 'contact.png'
        ]),
        'backgrounds' => json_encode([
            'home' => [

            ],
            'products' => [

            ],
            'blog' => [

            ],
            'about' => [

            ],
            'contact' => [

            ]
        ]),
        'contact' => json_encode([
            'email' => 'contacto@miempresa.com',
            'phone' => '+(52) 012 345 6789',
            'address' => '',
            'social_media' => [
                'facebook' => '',
                'instagram' => '',
                'twitter' => '',
                'youtube' => '',
                'googleplus' => ''
            ]
        ]),
        'about' => json_encode([
            'description' => [
                'es' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a,',
                'en' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a,'
            ],
            'mission' => [
                'es' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a,',
                'en' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a,'
            ],
            'vission' => [
                'es' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a,',
                'en' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a,'
            ],
            'values' => [
                'es' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a,',
                'en' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a,'
            ]
        ]),
        'notices' => json_encode([
            'privacy' => [
                'es' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a,',
                'en' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a,'
            ],
            'transparency' => [
                'es' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a,',
                'en' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a,'
            ],
            'terms_and_conditions' => [
                'es' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a,',
                'en' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a,'
            ]
        ]),
        'currency_exchange' => json_encode([
            'MXN' => 1,
            'USD' => 18,
            'EUR' => 21
        ]),
        'seo' => json_encode([
            'titles' => [
                'home' => [
                    'es' => 'Inicio',
                    'en' => 'Home'
                ],
                'products' => [
                    'es' => 'Productos',
                    'en' => 'Products'
                ],
                'blog' => [
                    'es' => 'Blog',
                    'en' => 'Blog'
                ],
                'about' => [
                    'es' => 'Acerca',
                    'en' => 'About'
                ],
                'contact' => [
                    'es' => 'Contacto',
                    'en' => 'Contact'
                ],
                'slogan' => [
                    'es' => '',
                    'en' => ''
                ]
            ],
            'keywords' => [
                'home' => [
                    'es' => 'Lorem ipsum dolor sit',
                    'en' => 'Lorem ipsum dolor sit'
                ],
                'products' => [
                    'es' => 'Lorem ipsum dolor sit',
                    'en' => 'Lorem ipsum dolor sit'
                ],
                'blog' => [
                    'es' => 'Lorem ipsum dolor sit',
                    'en' => 'Lorem ipsum dolor sit'
                ],
                'about' => [
                    'es' => 'Lorem ipsum dolor sit',
                    'en' => 'Lorem ipsum dolor sit'
                ],
                'contact' => [
                    'es' => 'Lorem ipsum dolor sit',
                    'en' => 'Lorem ipsum dolor sit'
                ]
            ],
            'descriptions' => [
                'home' => [
                    'es' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commo',
                    'en' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commo'
                ],
                'products' => [
                    'es' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commo',
                    'en' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commo'
                ],
                'blog' => [
                    'es' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commo',
                    'en' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commo'
                ],
                'about' => [
                    'es' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commo',
                    'en' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commo'
                ],
                'contact' => [
                    'es' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commo',
                    'en' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commo'
                ]
            ]
        ]),
    ]);
}
