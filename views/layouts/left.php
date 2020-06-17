<?php

use app\models\User;

?>

<aside class="main-sidebar slimScrollBar" style="position: fixed; overflow-y: auto; height: 100%;">

    <section class="sidebar slimScrollBar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=\app\models\PerfilUsuario::find()->where('a01_id=:user', [':user'=>Yii::$app->user->getId()])->one()->a02_nombre?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Buscar"/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>-->
        <!-- /.search form -->

            <?= dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'Menú principal', 'options' => ['class' => 'header']],
                        ['label' => 'Inicio', 'icon' => 'fa fa-home', 'url' => ['/site/index']],
                        [
                            'label' => 'Catálogos',
                            'icon' => 'fa fa-archive',
                            'visible' => Yii::$app->user->can('/medicos/*') || Yii::$app->user->can('/razas/*') || Yii::$app->user->can('/tipos-prueba/*') || Yii::$app->user->can('/motivos-prueba/*'),
                            'url' => '#',
                            'items' => [
                                ['label' => 'Médicos', 'icon' => 'fa fa-stethoscope', 'visible' => Yii::$app->user->can('/medicos/*'), 'url' => ['#'],
                                    'items' => [
                                        ['label' => 'Agregar Médico', 'icon' => 'fa fa-plus', 'url' => ['/medicos/create'],],
                                        ['label' => 'Ver todos', 'icon' => 'fa fa-list', 'url' => ['/medicos/']],
                                    ],
                                ],
                                ['label' => 'Razas', 'icon' => 'fa fa-paw', 'visible' => Yii::$app->user->can('/razas/*'), 'url' => ['#'],
                                    'items' => [
                                        ['label' => 'Agregar Raza', 'icon' => 'fa fa-plus', 'url' => ['/razas/create'],],
                                        ['label' => 'Ver todas', 'icon' => 'fa fa-list', 'url' => ['/razas/']],
                                    ],
                                ],
                                ['label' => 'Tipos de prueba', 'icon' => 'fa fa-tags', 'visible' => Yii::$app->user->can('/tipos-prueba/*'), 'url' => ['#'],
                                    'items' => [
                                        ['label' => 'Agregar Tipo de Prueba', 'icon' => 'fa fa-plus', 'url' => ['/tipos-prueba/create'],],
                                        ['label' => 'Ver todos', 'icon' => 'fa fa-list', 'url' => ['/tipos-prueba/']],
                                    ],
                                ],
                                ['label' => 'Motivos de prueba', 'icon' => 'fa fa-archive ', 'visible' => Yii::$app->user->can('/motivos-prueba/*'), 'url' => ['#'],
                                    'items' => [
                                        ['label' => 'Agregar Motivo', 'icon' => 'fa fa-plus', 'url' => ['/motivos-prueba/create'],],
                                        ['label' => 'Ver todos', 'icon' => 'fa fa-list', 'url' => ['/motivos-prueba/']],
                                    ],
                                ],
                                ['label' => 'Productos', 'icon' => 'fa fa-flask ', 'visible' => Yii::$app->user->can('/productos/*'), 'url' => ['#'],
                                    'items' => [
                                        ['label' => 'Agregar producto', 'icon' => 'fa fa-plus', 'url' => ['/productos/create'],],
                                        ['label' => 'Ver todos', 'icon' => 'fa fa-list', 'url' => ['/productos/']],
                                    ],
                                ],
                                /*['label' => 'Rutas', 'icon' => 'fa fa-bus ', 'visible' => Yii::$app->user->can('/rutas/*'), 'url' => ['#'],
                                    'items' => [
                                        ['label' => 'Agregar ruta', 'icon' => 'fa fa-plus', 'url' => ['/rutas/create'],],
                                        ['label' => 'Ver todas', 'icon' => 'fa fa-list', 'url' => ['/rutas/']],
                                    ],
                                ],
                                ['label' => 'PVI', 'icon' => 'fa fa-building', 'visible' => \app\models\User::isCuenta52(Yii::$app->user->getId()), 'url' => ['#'],
                                    'items' => [
                                        ['label' => 'Agregar PVI', 'icon' => 'fa fa-plus', 'url' => ['/pvi/create'],],
                                        ['label' => 'Ver todos', 'icon' => 'fa fa-list', 'url' => ['/pvi/']],

                                        ['label' => 'Responsables', 'icon' => 'fa fa-user', 'url' => ['#'],
                                            'items' => [
                                                ['label' => 'Agregar Responsable', 'icon' => 'fa fa-plus', 'url' => ['/responsables-pvi/create'],],
                                                ['label' => 'Ver todos', 'icon' => 'fa fa-list', 'url' => ['/responsables-pvi/']],
                                            ],
                                        ],
                                    ],
                                ],*/
                                ['label' => 'Ejidos', 'icon' => 'fa fa-flask ', 'visible' => \app\models\User::isCuenta52(Yii::$app->user->getId()), 'url' => ['#'],
                                    'items' => [
                                        ['label' => 'Agregar Ejido', 'icon' => 'fa fa-plus', 'url' => ['/ejido/create'],],
                                        ['label' => 'Ver todos', 'icon' => 'fa fa-list', 'url' => ['/ejido/']],
                                    ],
                                ],
                                ['label' => 'Anexo', 'icon' => 'fa fa-flask ', 'visible' => \app\models\User::isCuenta52(Yii::$app->user->getId()), 'url' => ['#'],
                                    'items' => [
                                        ['label' => 'Agregar Anexo', 'icon' => 'fa fa-plus', 'url' => ['/anexo/create'],],
                                        ['label' => 'Ver todos', 'icon' => 'fa fa-list', 'url' => ['/anexo/']],
                                    ],
                                ],
                            ],
                        ],

                        [
                            'label' => 'Registros',
                            'icon' => 'fa fa-list ',
                            'visible' => Yii::$app->user->can('/unidades/*') || Yii::$app->user->can('/ganaderos/*'),
                            'url' => '#',
                            'items' => [
                                ['label' => 'UPP', 'icon' => 'fa fa-map-marker', 'visible' => Yii::$app->user->can('/unidades/*'), 'url' => ['/unidades/create'],
                                    /*'items' => [
                                        ['label' => 'Agregar UPP', 'icon' => 'fa fa-plus', 'url' => ['/unidades/create'],],
                                        ['label' => 'Ver todas', 'icon' => 'fa fa-list', 'url' => ['/unidades/']],
                                        ['label' => 'Cuarentena', 'icon' => 'fa fa-ban', 'url' => ['#']],
                                    ],*/
                                ],
                                ['label' => 'Productores', 'icon' => 'fa fa-user-circle-o', 'visible' => Yii::$app->user->can('/ganaderos/*'), 'url' => ['/ganaderos/create'],
                                    /*'items' => [
                                        ['label' => 'Agregar Productor', 'icon' => 'fa fa-plus', 'url' => ['/ganaderos/create'],],
                                        ['label' => 'Ver todos', 'icon' => 'fa fa-list', 'url' => ['/ganaderos/']],
                                    ],*/
                                ],
                            ],
                        ],
                        [
                            'label' => 'Reseñas',
                            'icon' => 'fa fa-check-square-o',
                            'visible' => Yii::$app->user->can('/resenas/*'),
                            'url' => '#',
                            'items' => [
                                //['label' => 'Asignaciones', 'icon' => 'fa fa-code-fork ', 'url' => ['asignacion-medico/']],
                                ['label' => 'Generar reseña', 'icon' => 'fa fa-plus', 'url' => ['/resenas/create'],],
                                ['label' => 'Ver todas', 'icon' => 'fa fa-list', 'url' => ['/resenas/']],
                            ],
                        ],
                        [
                            'label' => 'Pruebas',
                            'icon' => 'fa fa-stethoscope',
                            'visible' => Yii::$app->user->can('/seleccion-previa/*'),
                            'url' => '#',
                            'items' => [
                                //['label' => 'Asignaciones', 'icon' => 'fa fa-code-fork ', 'url' => ['asignacion-medico/']],
                                ['label' => 'Generar Prueba', 'icon' => 'fa fa-plus', 'url' => ['/seleccion-previa/create'],],
                                ['label' => 'Ver todas', 'icon' => 'fa fa-list', 'url' => ['/seleccion-previa/']],

                            ],
                        ],
                       [
                           'label' => 'Dictámenes',
                           'icon' => 'fa fa-medkit',
                           'visible' => (Yii::$app->user->can('/tuberculosis/*') || Yii::$app->user->can('/brucelosis/*') || Yii::$app->user->can('/vacunacion/*')),
                           'url' => '#',
                           'items' => [
                                ['label' => 'Tuberculosis', 'icon' => 'fa fa-flask', 'visible' => Yii::$app->user->can('/tuberculosis/*'), 'url' => ['/tuberculosis/']],
                                ['label' => 'Brucelosis', 'icon' => 'fa fa-thermometer-three-quarters', 'visible' => Yii::$app->user->can('/brucelosis/*'), 'url' => ['/brucelosis/']],
                                ['label' => 'Constancia de vacunación', 'icon' => 'fa fa-eyedropper', 'visible' => Yii::$app->user->can('/vacunacion/*'), 'url' => ['/vacunacion/']],
                                ['label' => 'Constancia de Garrapaticida', 'icon' => 'fa fa-shower', 'visible' => Yii::$app->user->can('/garrapatas/*'), 'url' => ['/garrapatas/']],
                                ['label' => 'Rabia', 'icon' => 'fa fa-eyedropper', 'visible' => Yii::$app->user->can('/vacunacion/*'), 'url' => ['#']],
                                ['label' => 'Lista Posibles Repetidos', 'icon' => 'fa fa-repeat', 'visible' => Yii::$app->user->can('/admin/*'), 'url' => ['/dictamenes-repetidos/index'],],
                                ['label' => 'Lista Dictámenes Eliminados', 'icon' => 'fa fa-list', 'visible' => Yii::$app->user->can('/admin/*'), 'url' => ['/dictamenes-eliminados/index'],],
                           ],
                       ],
                        [
                            'label' => 'Aretes',
                            'icon' => 'fa fa-tags',
                            'visible' => (Yii::$app->user->can('/folios-medicos/*') || Yii::$app->user->can('/folios-supervisor/*') || Yii::$app->user->can('/admin/*') || Yii::$app->user->can('/aretes/*') ),
                            'url' => '#',
                            'items' => [
                                ['label' => 'Consulta de Aretes', 'icon' => 'fa fa-search', 'visible' => (Yii::$app->user->can('/folios-medicos/*') || Yii::$app->user->can('/folios-supervisor/*') || Yii::$app->user->can('/admin/*') || Yii::$app->user->can('/aretes/*') ), 'url' => ['/site/consultararete'],],
                                ['label' => 'Editar Arete', 'icon' => 'fa fa-edit', 'visible' => Yii::$app->user->can('/admin/*'), 'url' => ['/aretes/index'],],
                                ['label' => 'Lista Aretes Modificados', 'icon' => 'fa fa-list', 'visible' => Yii::$app->user->can('/admin/*'), 'url' => ['/modificacion-arete/index'],],
                            ],
                        ],
                        [
                            'label' => 'Folios',
                            'icon' => 'fa fa-file',
                            'visible' => (Yii::$app->user->can('/folios-medicos/*') || Yii::$app->user->can('/folios-supervisor/*') || Yii::$app->user->can('/admin/*') || Yii::$app->user->can('/folios-coordinador/*') ),
                            'url' => '#',
                            'items' => [
                                ['label' => 'Folios Nacionales', 'icon' => 'fa fa-file-text-o', 'visible' => ( User::isUserNacional(Yii::$app->user->getId()) || User::isUserSuperAdmin(Yii::$app->user->getId()) ), 'url' => ['#'],
                                    'items' => [
                                        ['label' => 'Asignar', 'icon' => 'fa fa-plus', 'url' => ['/folios-nacional/create'],],
                                        ['label' => 'Ver Folios', 'icon' => 'fa fa-list', 'url' => ['/folios-nacional/index'],],
                                    ],
                                ],
                                ['label' => 'Folios Estatales', 'icon' => 'fa fa-file-text-o', 'visible' => (User::isUserNacional(Yii::$app->user->getId()) || User::isUserSuperAdmin(Yii::$app->user->getId()) || User::isUserEstatal(Yii::$app->user->getId()) ), 'url' => ['#'],
                                    'items' => [
                                        ['label' => 'Asignar', 'icon' => 'fa fa-plus', 'url' => ['/folios-estatal/create'],],
                                        ['label' => 'Ver Folios', 'icon' => 'fa fa-list', 'url' => ['/folios-estatal/index'],],
                                    ],
                                ],
                                /*['label' => 'Folios Administradores', 'icon' => 'fa fa-file-text-o', 'visible' => (Yii::$app->user->can('/folios-administrador/*') ), 'url' => ['#'],
                                    'items' => [
                                        ['label' => 'Asignar', 'icon' => 'fa fa-plus', 'visible' => (Yii::$app->user->can('/folios-estatal/*') ), 'url' => ['/folios-administrador/create'],],
                                        ['label' => 'Ver Folios', 'icon' => 'fa fa-list', 'visible' => (Yii::$app->user->can('/folios-administrador/*') ), 'url' => ['/folios-administrador/index'],],
                                    ],
                                ],*/
                                    ['label' => 'Folios Coordinadores', 'icon' => 'fa fa-file-text-o', 'visible' => (Yii::$app->user->can('/admin/*') || Yii::$app->user->can('/folios-coordinador/*') ), 'url' => ['#'],
                                    'items' => [
                                        ['label' => 'Asignar', 'icon' => 'fa fa-plus', 'visible' => (Yii::$app->user->can('/admin/*') ), 'url' => ['/folios-coordinador/create'],],
                                        ['label' => 'Ver Folios', 'icon' => 'fa fa-list', 'visible' => (Yii::$app->user->can('/admin/*') || Yii::$app->user->can('/folios-coordinador/*') ), 'url' => ['/folios-coordinador/index'],],
                                    ],
                                ],
                                ['label' => 'Folios Supervisores', 'icon' => 'fa fa-file-text-o', 'visible' => (Yii::$app->user->can('/admin/*') || Yii::$app->user->can('/folios-coordinador/*') || Yii::$app->user->can('/folios-supervisor/*') ), 'url' => ['#'],
                                    'items' => [
                                        ['label' => 'Asignar', 'icon' => 'fa fa-plus', 'visible' => (Yii::$app->user->can('/admin/*') || Yii::$app->user->can('/folios-coordinador/*') ), 'url' => ['/folios-supervisor/create'],],
                                        ['label' => 'Ver Folios', 'icon' => 'fa fa-list', 'visible' => (Yii::$app->user->can('/admin/*') || Yii::$app->user->can('/folios-supervisor/*') || Yii::$app->user->can('/folios-medicos/*') ), 'url' => ['/folios-supervisor/index'],],
                                    ],
                                ],
                                ['label' => 'Folios Médicos', 'icon' => 'fa fa-file-text-o', 'visible' => (Yii::$app->user->can('/admin/*') || Yii::$app->user->can('/folios-medicos/*') ), 'url' => ['#'],
                                    'items' => [
                                        ['label' => 'Asignar', 'icon' => 'fa fa-plus', 'visible' => (Yii::$app->user->can('/admin/*') || Yii::$app->user->can('/folios-medicos/*') ), 'url' => ['/folios-medicos/create'],],
                                    ],
                                ],
                                ['label' => 'Folios Cancelados', 'icon' => 'fa fa-file-excel-o', 'visible' => (Yii::$app->user->can('/admin/*') ), 'url' => ['/folios/'],],
                                ['label' => 'Buscar Folio', 'icon' => 'fa fa-search', 'visible' => (Yii::$app->user->can('/admin/*') || Yii::$app->user->can('/folios-medicos/*') || Yii::$app->user->can('/folios-supervisor/*') ), 'url' => ['/folios/buscar'],],
                            ],
                        ],
                        [
                            'label' => 'Rastro',
                            'icon' => 'fa fa-barcode',
                            'visible' => Yii::$app->user->can('/rastro/*'),
                            'url' => '#',
                            'items' => [
                                //['label' => 'Asignaciones', 'icon' => 'fa fa-code-fork ', 'url' => ['asignacion-medico/']],
                                ['label' => 'Generar entrada', 'icon' => 'fa fa-plus', 'url' => ['/rastro/create'],],
                                ['label' => 'Ver todas', 'icon' => 'fa fa-list', 'url' => ['/rastro/']],

                            ],
                        ],

                        [
                            'label' => 'REEMO',
                            'icon' => 'fa fa-truck ',
                            'visible' => Yii::$app->user->can('/remo/*'),
                            'url' => '#',
                            'items' => [
                                ['label' => 'Manual', 'icon' => 'fa fa-hand-paper-o', 'url' => ['#'],
                                    'items' => [
                                        ['label' => 'Generar REEMO', 'icon' => 'fa fa-plus', 'url' => ['/reemo-manual/create'],],
                                        ['label' => 'Ver todo', 'icon' => 'fa fa-list', 'url' => ['/reemo-manual/index']],
                                    ],
                                ],
                                ['label' => 'Importación', 'icon' => 'fa fa-cloud-upload', 'url' => ['/importaciones/']],
                                //['label' => 'Importación', 'icon' => 'fa fa-user-circle-o', 'url' => ['/remo/create'],
                                //],
                            ],
                        ],

                        [
                            'label' => 'Asignación',
                            'icon' => 'fa fa-handshake-o  ',
                            'visible' => Yii::$app->user->can('/asignacion-identificadores/*'),
                            'url' => '#',
                            'items' => [
                                ['label' => 'Aretes', 'icon' => 'fa fa-tags', 'url' => ['#'],
                                    'items' => [
                                        ['label' => 'Asignar Aretes', 'icon' => 'fa fa-hand-paper-o', 'visible' => Yii::$app->user->can('/admin/*'), 'url' => ['/asignacion-identificadores/create'],],
                                        ['label' => 'Ver todo', 'icon' => 'fa fa-list', 'url' => ['/asignacion-identificadores/index']],
                                    ],
                                ],
                            ],
                        ],
                        ['label' => 'Reportes', 'icon' => 'fa fa-line-chart ', 'visible' => Yii::$app->user->can('/reportes/*'),'url' => ['/site/reportes']],


                        [
                            'label' => 'Sanidad',
                            'icon' => 'fa fa-thermometer-half ',
                            'url' => '#',
                            'visible' => Yii::$app->user->can('dictamen'),
                            'items' => [
                                ['label' => 'Dictamen', 'icon' => 'fa fa-eyedropper ', 'url' => '#',],
                                ['label' => 'Identificación', 'icon' => 'fa fa-address-card-o', 'url' => '#',],
                            ],
                        ],

                        //Mapa de calor
                        [
                            'label' => 'Mapear Información',
                            'icon' => 'fa fa-map-o ',
                            'visible' => User::isCuenta52(Yii::$app->user->getId()) || User::isUserMapa(Yii::$app->user->getId()),
                            'url' => '#',
                            'items' => [
                                ['label' => 'Tasa de Respuesta', 'icon' => 'fa fa-map-marker', 'visible' => User::isCuenta52(Yii::$app->user->getId()) || User::isUserMapa(Yii::$app->user->getId()), 'url' => ['/mapa-calor/index'],
                                    /*'items' => [
                                        ['label' => 'Agregar UPP', 'icon' => 'fa fa-plus', 'url' => ['/unidades/create'],],
                                        ['label' => 'Ver todas', 'icon' => 'fa fa-list', 'url' => ['/unidades/']],
                                        ['label' => 'Cuarentena', 'icon' => 'fa fa-ban', 'url' => ['#']],
                                    ],*/
                                ],
                            ],
                        ],

                        //Configuración
                        [
                            'label' => 'Configuración',
                            'icon' => 'fa fa-gears',
                            'visible' => Yii::$app->user->can('/admin/*') || Yii::$app->user->can('/grupos/*'),
                            'url' => '#',
                            'items' => [
                                //Control de acceso
                                [
                                    'label' => 'Control de acceso',
                                    'icon' => 'fa fa-child',
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Usuarios', 'icon' => 'fa fa-users', 'url' => ['#'],
                                            'items' => [
                                                ['label' => 'Agregar Usuario', 'icon' => 'fa fa-plus', 'url' => ['/perfil-usuario/create'],],
                                                ['label' => 'Ver todos', 'icon' => 'fa fa-list', 'url' => ['/perfil-usuario/list']],
                                            ],
                                        ],

                                        //['label' => 'Asignación', 'icon' => 'fa fa-lock', 'url' => ['/admin/assignment']],
                                        ['label' => 'Roles', 'icon' => 'fa fa-tag', 'url' => ['#'],
                                            'items' => [
                                                ['label' => 'Agregar Rol', 'icon' => 'fa fa-plus', 'url' => ['/admin/role/create'],],
                                                ['label' => 'Ver todos', 'icon' => 'fa fa-list', 'url' => ['/admin/role']],
                                            ],
                                        ],
                                        //['label' => 'Permisos', 'icon' => 'fa fa-lock', 'url' => ['/admin/permission']],
                                        //['label' => 'Acciones', 'icon' => 'fa fa-shield', 'url' => ['/admin/route']],
                                    ],
                                ],
                                ['label' => 'Grupos Usuarios', 'icon' => 'fa fa-address-book', 'visible' => Yii::$app->user->can('/grupos/*'), 'url' => ['/grupos/'],
                                    'items' => [
                                        ['label' => 'Agregar Grupo', 'icon' => 'fa fa-plus', 'url' => ['/grupos/create'],],
                                        ['label' => 'Ver todos', 'icon' => 'fa fa-list', 'url' => ['/grupos/']],
                                    ],
                                ],
                                //['label' => 'Grupos Usuarios', 'icon' => 'fa fa-address-book', 'url' => ['/grupos/']],
                                ['label' => 'Bitácora de Accesos', 'icon' => 'fa fa-calendar', 'visible' => Yii::$app->user->can('/bitacora/*'), 'url' => ['/bitacora/']],
                                //['label' => 'Importación de datos', 'icon' => 'fa fa-cloud-upload', 'url' => ['/importaciones/']],
                                ['label' => 'Notificaciones', 'icon' => 'fa fa-envelope', 'visible' => Yii::$app->user->can('/parametros/*'), 'url' => ['/parametros/'],
                                    'items' => [
                                        ['label' => 'Agregar Notificación', 'icon' => 'fa fa-plus', 'url' => ['/parametros/create'],],
                                        ['label' => 'Ver todas', 'icon' => 'fa fa-list', 'url' => ['/parametros/']],
                                    ],
                                ],
                            ],
                        ],
                        ['label' => 'Contacto', 'icon' => 'fa fa-info-circle', 'url' => ['/site/contact']],
                        //['label' => 'Ayuda', 'icon' => 'fa fa-info-circle', 'url' => ['/site/manual']],

                       // ['label' => 'REEMO', 'icon' => 'fa fa-hospital-o ', 'url' => ['#'], 'visible' => Yii::$app->user->can('configuraciones'),],


                    ],
                ]
            ) ?>


    </section>

</aside>
