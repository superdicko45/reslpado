<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaticContent extends Model
{
	const FASES = [
		'alumnos'=>[
        	'name'=>'Alumnos',
        	'data'=>[
                'matricula'=>[
                    'nombre'=>'matricula',
                    'tipo'=>'hidden',
                    'requerido'=>false
                ],
                'nombre'=>[
                    'nombre'=>"Nombre del alumno *",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'ape_paterno'=>[
                    'nombre'=>"Apellido Paterno *",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'ape_materno'=>[
                    'nombre'=>"Apellido Materno *",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'sexo'=>[
                    'nombre'=>'Género *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Masculino','Femenino'],
                    'long'=>100,
                    'requerido'=>true
                ],
                'curp'=>[
                    'nombre'=>"curp *",
                    'tipo'=>'string',
                    'long'=>18,
                    'requerido'=>true
                ],
                'tel_movil'=>[
                    'nombre'=>'Teléfono del Alumno *',
                    'tipo'=>'phone',
                    'long'=>10,
                    'requerido'=>true
                ],
                'fecha_nac'=>[
                    'nombre'=>'Fecha de Nacimiento',
                    'tipo'=>'date',
                    'long'=>100,
                    'requerido'=>false
                ],
                'edad'=>[
                    'nombre'=>'Edad *',
                    'tipo'=>'integer',
                    'long'=>100,
                    'requerido'=>true
                ],
                'direccion'=>[
                    'nombre'=>'Dirrección',
                    'tipo'=>'textarea',
                    'long'=>200,
                    'requerido'=>false
                ],
                'email'=>[
                    'nombre'=>'email del Alumno *',
                    'tipo'=>'mail',
                    'long'=>100,
                    'requerido'=>true
                ],
                'tutor'=>[
                    'nombre'=>'Nombre Completo del Tutor',
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>false
                ],
                'tel_tutor'=>[
                    'nombre'=>'Teléfono del Tutor',
                    'tipo'=>'phone',
                    'long'=>10,
                    'requerido'=>false
                ],
                'fecha_ingreso'=>[
                    'nombre'=>'Fecha de Ingreso *',
                    'tipo'=>'date',
                    'long'=>100,
                    'requerido'=>true
                ],
                'grado'=>[
                    'nombre'=>'Grado *',
                    'tipo'=>'integer',
                    'long'=>100,
                    'requerido'=>true
                ],
                'id_cat_status'=>[
                    'nombre'=>'Status del Alumno *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Matriculado','No Matriculado','Baja Temporal','Baja Permanente','Pasante'],
                    'long'=>100,
                    'requerido'=>true
                ],
                'status'=>[
                    'nombre'=>'Situación del Alumno *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Alumno regular', 'Alumno irregular'],
                    'long'=>100,
                    'requerido'=>true
                ],
                /*
                'id_carrera'=>[
                    'nombre'=>'Carera *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'mule',
                        'type'=>'GET',
                        'method'=>'/GestionEscolar/select/cat_status_alumno',
                        'port'=>'8081',
                        'id'=>'id_status',
                        'name'=>'status',
                        'parameters'=>''
                    ],
                    'long'=>100,
                    'requerido'=>true
                ],
                */
                'turno'=>[
                    'nombre'=>'Turno *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Matutino','Verspertino','Nocturno','Mixto'],
                    'long'=>100,
                    'requerido'=>true
                ],
                'id_carrera'=>[
                    'nombre'=>'Carrera *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>[],
                    'long'=>1000,
                    'requerido'=>true
                ],
                'id_ciclo'=>[
                    'nombre'=>'Ciclo Escolar *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>[],
                    'long'=>1000,
                    'requerido'=>true
                ]
            ]    
        ],
        'e_alumnos'=>[
            'name'=>'Alumnos',
            'data'=>[
                'matricula'=>[
                    'nombre'=>'matricula',
                    'tipo'=>'hidden',
                    'requerido'=>false
                ],
                'nombre'=>[
                    'nombre'=>"Nombre del alumno *",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'ape_paterno'=>[
                    'nombre'=>"Apellido Paterno *",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'ape_materno'=>[
                    'nombre'=>"Apellido Materno *",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'sexo'=>[
                    'nombre'=>'Género *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Masculino','Femenino'],
                    'long'=>100,
                    'requerido'=>true
                ],
                'curp'=>[
                    'nombre'=>"curp *",
                    'tipo'=>'string',
                    'long'=>18,
                    'requerido'=>true
                ],
                'tel_movil'=>[
                    'nombre'=>'Teléfono del Alumno *',
                    'tipo'=>'phone',
                    'long'=>10,
                    'requerido'=>true
                ],
                'fecha_nac'=>[
                    'nombre'=>'Fecha de Nacimiento',
                    'tipo'=>'date',
                    'long'=>100,
                    'requerido'=>false
                ],
                'edad'=>[
                    'nombre'=>'Edad *',
                    'tipo'=>'integer',
                    'long'=>100,
                    'requerido'=>true
                ],
                'direccion'=>[
                    'nombre'=>'Dirrección',
                    'tipo'=>'textarea',
                    'long'=>200,
                    'requerido'=>false
                ],
                'email'=>[
                    'nombre'=>'email del Alumno *',
                    'tipo'=>'mail',
                    'long'=>100,
                    'requerido'=>true
                ],
                'tutor'=>[
                    'nombre'=>'Nombre Completo del Tutor',
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>false
                ],
                'tel_tutor'=>[
                    'nombre'=>'Teléfono del Tutor',
                    'tipo'=>'phone',
                    'long'=>10,
                    'requerido'=>false
                ],
                'fecha_ingreso'=>[
                    'nombre'=>'Fecha de Ingreso *',
                    'tipo'=>'date',
                    'long'=>100,
                    'requerido'=>true
                ],
                'id_cat_status'=>[
                    'nombre'=>'Status del Alumno *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Matriculado','No Matriculado','Baja Temporal','Baja Permanente','Pasante'],
                    'long'=>100,
                    'requerido'=>true
                ],
                'turno'=>[
                    'nombre'=>'Turno *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Matutino','Verspertino','Nocturno','Mixto'],
                    'long'=>100,
                    'requerido'=>true
                ]
            ]    
        ],
        'r_alumnos'=>[
            'name'=>'Alumnos',
            'data'=>[
                'matricula'=>[
                    'nombre'=>'matricula',
                    'tipo'=>'hidden',
                    'requerido'=>false
                ],
                'id_pre'=>[
                    'nombre'=>'id_pre',
                    'tipo'=>'hidden',
                    'requerido'=>false
                ],
                'nombre'=>[
                    'nombre'=>"Nombre del alumno *",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'ape_paterno'=>[
                    'nombre'=>"Apellido Paterno *",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'ape_materno'=>[
                    'nombre'=>"Apellido Materno *",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'sexo'=>[
                    'nombre'=>'Género *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Masculino','Femenino'],
                    'long'=>100,
                    'requerido'=>true
                ],
                'curp'=>[
                    'nombre'=>"curp *",
                    'tipo'=>'string',
                    'long'=>18,
                    'requerido'=>true
                ],
                'tel_movil'=>[
                    'nombre'=>'Teléfono del Alumno *',
                    'tipo'=>'phone',
                    'long'=>10,
                    'requerido'=>true
                ],
                'tel_tutor'=>[
                    'nombre'=>'Teléfono del Tutor',
                    'tipo'=>'phone',
                    'long'=>10,
                    'requerido'=>false
                ],
                'fecha_nac'=>[
                    'nombre'=>'Fecha de Nacimiento',
                    'tipo'=>'date',
                    'long'=>100,
                    'requerido'=>false
                ],
                'edad'=>[
                    'nombre'=>'Edad *',
                    'tipo'=>'integer',
                    'long'=>100,
                    'requerido'=>true
                ],
                'direccion'=>[
                    'nombre'=>'Dirrección',
                    'tipo'=>'textarea',
                    'long'=>200,
                    'requerido'=>false
                ],
                'email'=>[
                    'nombre'=>'email del Alumno *',
                    'tipo'=>'mail',
                    'long'=>100,
                    'requerido'=>true
                ],
                'tutor'=>[
                    'nombre'=>'Nombre Completo del Tutor',
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>false
                ],
                'tel_tutor'=>[
                    'nombre'=>'Teléfono del Tutor',
                    'tipo'=>'phone',
                    'long'=>10,
                    'requerido'=>false
                ],
                'fecha_ingreso'=>[
                    'nombre'=>'Fecha de Ingreso *',
                    'tipo'=>'date',
                    'long'=>100,
                    'requerido'=>true
                ],
                'grado'=>[
                    'nombre'=>'Grado *',
                    'tipo'=>'integer',
                    'long'=>100,
                    'requerido'=>true
                ],
                'id_cat_status'=>[
                    'nombre'=>'Status del Alumno *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Matriculado','No Matriculado','Baja Temporal','Baja Permanente','Pasante'],
                    'long'=>100,
                    'requerido'=>true
                ],
                'status'=>[
                    'nombre'=>'Situación del Alumno *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Alumno regular', 'Alumno irregular'],
                    'long'=>100,
                    'requerido'=>true
                ],
                'turno'=>[
                    'nombre'=>'Turno *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Matutino','Verspertino','Nocturno','Mixto'],
                    'long'=>100,
                    'requerido'=>true
                ],
                'nom_carrera'=>[
                    'nombre'=>'Carrera *',
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>false
                ],
                
                'id_ciclo'=>[
                    'nombre'=>'Ciclo Escolar *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>[],
                    'long'=>1000,
                    'requerido'=>true
                ]
            ]    
        ],
        'profesores'=>[
            'name'=>'Profesores',
            'data'=>[
                'id_profesor'=>[
                    'nombre'=>'id_profesor',
                    'tipo'=>'hidden',
                    'requerido'=>false
                ],
                'nombre'=>[
                    'nombre'=>"Nombre del Profesor *",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'ape_paterno'=>[
                    'nombre'=>"Apellido Paterno *",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'ape_materno'=>[
                    'nombre'=>"Apellido Materno *",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'sexo'=>[
                    'nombre'=>'Género *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Masculino','Femenino'],
                    'long'=>100,
                    'requerido'=>true
                ],
                'curp'=>[
                    'nombre'=>"curp *",
                    'tipo'=>'string',
                    'long'=>18,
                    'requerido'=>true
                ],
                'fecha_nac'=>[
                    'nombre'=>'Fecha de Nacimiento',
                    'tipo'=>'date',
                    'long'=>100,
                    'requerido'=>false
                ],
                'edad'=>[
                    'nombre'=>'Edad *',
                    'tipo'=>'integer',
                    'long'=>100,
                    'requerido'=>true
                ],
                'direccion'=>[
                    'nombre'=>'Dirrección',
                    'tipo'=>'textarea',
                    'long'=>100,
                    'requerido'=>false
                ],
                'email'=>[
                    'nombre'=>'Email *',
                    'tipo'=>'mail',
                    'long'=>100,
                    'requerido'=>true
                ],
                'password'=>[
                    'nombre'=>'Password *',
                    'tipo'=>'password',
                    'long'=>100,
                    'requerido'=>false
                ],
                'tel_fijo'=>[
                    'nombre'=>'Teléfono Principal',
                    'tipo'=>'phone',
                    'long'=>10,
                    'requerido'=>false
                ],
                'tel_movil'=>[
                    'nombre'=>'Teléfono Celular',
                    'tipo'=>'phone',
                    'long'=>10,
                    'requerido'=>false
                ],
                'fecha_ingreso'=>[
                    'nombre'=>'Fecha de Ingreso *',
                    'tipo'=>'date',
                    'long'=>100,
                    'requerido'=>true
                ],
                'seguro_social'=>[
                    'nombre'=>'Seguro Social *',
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'id_grado_aca'=>[
                    'nombre'=>'Nivel Academico *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Secundaria','Bachiller / Preparatoria','Licenciatura','Maestría','Doctorado'],
                    'long'=>100,
                    'requerido'=>true
                ],
                'observaciones'=>[
                    'nombre'=>'Observaciones del Profesor',
                    'tipo'=>'textarea',
                    'long'=>2000,
                    'requerido'=>false
                ],
                'cedula'=>[
                    'nombre'=>'Cédula Profesional',
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>false
                ],
                'turno'=>[
                    'nombre'=>'Turno *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Matutino','Verspertino','Nocturno','Mixto'],
                    'long'=>100,
                    'requerido'=>true
                ],
                'salario'=>[
                    'nombre'=>'Salario del Profesor',
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>false
                ],
                
                'id_cat_status'=>[
                    'nombre'=>'Status *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Jubilado','Interno','Externo'],
                    'long'=>100,
                    'requerido'=>true
                ],
                'area'=>[
                    'nombre'=>"Area de Conocimiento",
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Ciencias Biológicas, Químicas y de la Salud.','Ciencias Físico - Matemáticas y de las Ingenierías.', 'Ciencias Sociales.', 'Humanidades y de las Artes.'],
                    'long'=>100,
                    'requerido'=>false
                ]                
                
            ] 
        ],
        'admin'=>[
            'name'=>'Administradores',
            'data'=>[
                'id_admin'=>[
                    'nombre'=>'id_admin',
                    'tipo'=>'hidden',
                    'requerido'=>false
                ],
                'nombre'=>[
                    'nombre'=>"Nombre del Administrador *",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'ape_paterno'=>[
                    'nombre'=>"Apellido Paterno *",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'ape_materno'=>[
                    'nombre'=>"Apellido Materno *",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'sexo'=>[
                    'nombre'=>'Género *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Masculino','Femenino'],
                    'long'=>100,
                    'requerido'=>true
                ],
                 'edad'=>[
                    'nombre'=>'Edad *',
                    'tipo'=>'integer',
                    'long'=>100,
                    'requerido'=>true
                ],
                'curp'=>[
                    'nombre'=>"curp *",
                    'tipo'=>'string',
                    'long'=>18,
                    'requerido'=>true
                ],
                'fecha_nac'=>[
                    'nombre'=>'Fecha de Nacimiento',
                    'tipo'=>'date',
                    'long'=>100,
                    'requerido'=>false
                ],
                'cargo'=>[
                    'nombre'=>'Cargo *',
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'email'=>[
                    'nombre'=>'Email *',
                    'tipo'=>'mail',
                    'long'=>100,
                    'requerido'=>true
                ],
                'tel_fijo'=>[
                    'nombre'=>'Teléfono Principal',
                    'tipo'=>'phone',
                    'long'=>10,
                    'requerido'=>false
                ],
                'tel_movil'=>[
                    'nombre'=>'Teléfono Celular',
                    'tipo'=>'phone',
                    'long'=>10,
                    'requerido'=>false
                ],
                'direccion'=>[
                    'nombre'=>'Dirrección',
                    'tipo'=>'textarea',
                    'long'=>2000,
                    'requerido'=>false
                ],
                'seguro_social'=>[
                    'nombre'=>'Seguro Social',
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>false
                ],
                'nivel_academico'=>[
                    'nombre'=>'Nivel Academico *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Secundaria','Bachiller / Preparatoria','Licenciatura','Maestría','Doctorado'],
                    'long'=>100,
                    'requerido'=>true
                ],
                'fecha_ingreso'=>[
                    'nombre'=>'Fecha de Ingreso *',
                    'tipo'=>'date',
                    'long'=>100,
                    'requerido'=>true
                ]
                
                
            ] 
        ],
        'carreras'=>[
            'name'=>'Carreras',
            'data'=>[
                'id_carrera'=>[
                    'nombre'=>'id_carrera',
                    'tipo'=>'hidden',
                    'requerido'=>false
                ],
                'nom_carrera'=>[
                    'nombre'=>"Nombre de la Carrera *",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'jefe_carrera'=>[
                    'nombre'=>"Nombre Jefe de Carrera *",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'presentacion'=>[
                    'nombre'=>"Presentación de la Carrera",
                    'tipo'=>'textarea',
                    'long'=>2000,
                    'requerido'=>false
                ],
                'nom_plan_estudio'=>[
                    'nombre'=>"Nombre del Plan de Estudios *",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'siglas'=>[
                    'nombre'=>"Siglas de la Carrea ",
                    'tipo'=>'string',
                    'long'=>3,
                    'requerido'=>false
                ],
                'titulo'=>[
                    'nombre'=>"Titulo que se Otorga *",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'id_unidad_academica'=>[
                    'nombre'=>"Unidad Academica",
                    'tipo'=>'string',
                    'long'=>200,
                    'requerido'=>false
                ],
                'id_area_conocimiento'=>[
                    'nombre'=>"Area de Conocimiento",
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Ciencias Biológicas, Químicas y de la Salud.','Ciencias Físico - Matemáticas y de las Ingenierías.', 'Ciencias Sociales.', 'Humanidades y de las Artes.'],
                    'long'=>100,
                    'requerido'=>false
                ],
                'id_modalidad'=>[
                    'nombre'=>"Modalidad",
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>[],
                    'long'=>100,
                    'requerido'=>true
                ],
                'id_nom_periodo'=>[
                    'nombre'=>"Grados",
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>[],
                    'long'=>100,
                    'requerido'=>true
                ],
                'num_periodos'=>[
                    'nombre'=>"Duración de la Carrera",
                    'tipo'=>'integer',
                    'long'=>100,
                    'requerido'=>true
                ],
                'tel_contacto'=>[
                    'nombre'=>'Teléfono de Contacto',
                    'tipo'=>'phone',
                    'long'=>10,
                    'requerido'=>false
                ],
                'id_status'=>[
                    'nombre'=>'Status *',
                    'tipo' => 'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Vigente','En revisión','Expirado'],
                    'long'=>100,
                    'requerido'=>true
                ],
                'num_sep'=>[
                    'nombre'=>'Folio de SEP',
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>false
                ],
                'dges'=>[
                    'nombre'=>'DGES',
                    'tipo'=>'string',
                    'long'=>5,
                    'requerido'=>false
                ],
                'perfil_ingreso'=>[
                    'nombre'=>'Perfil de Ingreso',
                    'tipo'=>'textarea',
                    'long'=>2000,
                    'requerido'=>true
                ],
                'perfil_egreso'=>[
                    'nombre'=>'Perfil de Egreso',
                    'tipo'=>'textarea',
                    'long'=>2000,
                    'requerido'=>true
                ],
                'requisitos_ing'=>[
                    'nombre'=>'Requisitos de Ingreso',
                    'tipo'=>'textarea',
                    'long'=>2000,
                    'requerido'=>false
                ],
                'requisitos_egr'=>[
                    'nombre'=>'Requisitos de Egreso',
                    'tipo'=>'textarea',
                    'long'=>2000,
                    'requerido'=>false
                ],
                'nivel'=>[
                    'nombre'=>'Nivel *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Maestría', 'Licenciatura'],
                    'long'=>100,
                    'requerido'=>true
                ]
            ] 
        ],
        'carreras_vig'=>[
            'name'=>'Carreras',
            'data'=>[
                'id_carrera'=>[
                    'nombre'=>'id_carrera',
                    'tipo'=>'hidden',
                    'requerido'=>false
                ],
                'jefe_carrera'=>[
                    'nombre'=>"Nombre Jefe de Carrera *",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'presentacion'=>[
                    'nombre'=>"Presentación de la Carrera",
                    'tipo'=>'textarea',
                    'long'=>2000,
                    'requerido'=>false
                ],
                'id_unidad_academica'=>[
                    'nombre'=>"Unidad Academica",
                    'tipo'=>'string',
                    'long'=>200,
                    'requerido'=>false
                ],
                'id_area_conocimiento'=>[
                    'nombre'=>"Area de Conocimiento",
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Ciencias Biológicas, Químicas y de la Salud.','Ciencias Físico - Matemáticas y de las Ingenierías.', 'Ciencias Sociales.', 'Humanidades y de las Artes.'],
                    'long'=>100,
                    'requerido'=>false
                ],
                'id_modalidad'=>[
                    'nombre'=>"Modalidad",
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Escolarizada','Abierta','Mixta'],
                    'long'=>100,
                    'requerido'=>false
                ],
                'dges'=>[
                    'nombre'=>'DGES',
                    'tipo'=>'string',
                    'long'=>5,
                    'requerido'=>false
                ],
                'tel_contacto'=>[
                    'nombre'=>'Teléfono de Contacto',
                    'tipo'=>'phone',
                    'long'=>10,
                    'requerido'=>false
                ],
                'id_status'=>[
                    'nombre'=>'Status',
                    'tipo' => 'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Vigente','En revisión','Expirado'],
                    'long'=>100,
                    'requerido'=>true
                ],
                'perfil_ingreso'=>[
                    'nombre'=>'Perfil de Ingreso',
                    'tipo'=>'textarea',
                    'long'=>2000,
                    'requerido'=>true
                ],
                'perfil_egreso'=>[
                    'nombre'=>'Perfil de Egreso',
                    'tipo'=>'textarea',
                    'long'=>2000,
                    'requerido'=>true
                ],
                'requisitos_ing'=>[
                    'nombre'=>'Requisitos de Ingreso',
                    'tipo'=>'textarea',
                    'long'=>2000,
                    'requerido'=>false
                ],
                'requisitos_egr'=>[
                    'nombre'=>'Requisitos de Egreso',
                    'tipo'=>'textarea',
                    'long'=>2000,
                    'requerido'=>false
                ],
                'nivel'=>[
                    'nombre'=>'Nivel *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Maestría', 'Licenciatura'],
                    'long'=>100,
                    'requerido'=>true
                ]
            ] 
        ],
        'ciclos'=>[
            'name'=>'Ciclos',
            'data'=>[
                'id_ciclo'=>[
                    'nombre'=>'id_ciclo',
                    'tipo'=>'hidden',
                    'requerido'=>false
                ],
                'ciclo'=>[
                    'nombre'=>"Nombre del Ciclo Escolar *",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'fecha_inicio'=>[
                    'nombre'=>"Fecha Inicial del Ciclo *",
                    'tipo'=>'date',
                    'long'=>100,
                    'requiereAlmacenar'=>'_fechaInicio',
                    'requerido'=>true
                ],
                'fecha_final'=>[

                    'nombre'=>"Fecha Final del Ciclo *",
                    'tipo'=>'date',
                    'long'=>100,
                    'requiereValidar'=>'_fechaInicio',
                    'requerido'=>true
                ],
                'nivel'=>[
                    'nombre'=>'Nivel *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Maestría', 'Licenciatura'],
                    'long'=>100,
                    'requerido'=>true
                ]
            ] 
        ],
        'eventos'=>[
            'name'=>'Eventos',
            'data'=>[
                'id_eventos'=>[
                    'nombre'=>'id_eventos',
                    'tipo'=>'hidden',
                    'requerido'=>false
                ],
                'nombre'=>[
                    'nombre'=>"Titúlo del Evento *",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'descripcion'=>[
                    'nombre'=>"Descripción del Evento",
                    'tipo'=>'textarea',
                    'long'=>1000,
                    'requerido'=>false
                ],
                'fecha_evento'=>[
                    'nombre'=>"Fecha del Evento *",
                    'tipo'=>'datetime',
                    'long'=>100,
                    'requerido'=>true
                ]
            ] 
        ],
        'materias'=>[
            'name'=>'Materias',
            'data'=>[
                'id_materia'=>[
                    'nombre'=>'id_materia',
                    'tipo'=>'hidden',
                    'requerido'=>false
                ],
                'clave_materia'=>[
                    'nombre'=>'Clave *',
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'nom_materia'=>[
                    'nombre'=>"Nombre de la Materia *",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'descripcion'=>[
                    'nombre'=>"Descripcion de la Materia ",
                    'tipo'=>'textarea',
                    'long'=>2000,
                    'requerido'=>false
                ],
                'id_area_conocimiento'=>[
                    'nombre'=>"Area de Conocimiento",
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Ciencias Biológicas, Químicas y de la Salud.','Ciencias Físico - Matemáticas y de las Ingenierías.', 'Ciencias Sociales.', 'Humanidades y de las Artes.'],
                    'long'=>100,
                    'requerido'=>false
                ]
            ]
        ],
        'examenes'=>[
            'name'=>'Exámenes',
            'data'=>[
                'id_extraordinario'=>[
                    'nombre'=>'id_extraordinario',
                    'tipo'=>'hidden',
                    'requerido'=>false
                ],
                'num_alumnos'=>[
                    'nombre'=>"Numero de Alumnos",
                    'tipo'=>'integer',
                    'long'=>100,
                    'requerido'=>false
                ],
                'grupo'=>[
                    'nombre'=>"Grupo ",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>false
                ],
                'fecha_hora'=>[
                    'nombre'=>"Fecha y Hora del Exámen *",
                    'tipo'=>'datetime',
                    'long'=>100,
                    'requerido'=>true
                ],
                'id_profesor'=>[
                    'nombre'=>"Profesor *",
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>[],
                    'long'=>100,
                    'requerido'=>true
                ],
                'id_materia'=>[
                    'nombre'=>"Materia *",
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>[],
                    'long'=>100,
                    'requerido'=>true
                ],
                'id_ciclo'=>[
                    'nombre'=>'id_ciclo',
                    'tipo'=>'hidden',
                    'requerido'=>false
                ],        
            ]
        ],
        'grupos'=>[
            'name'=>'Grupo',
            'data'=>[
                'id_grupo'=>[
                    'nombre'=>'id_extraordinario',
                    'tipo'=>'hidden',
                    'requerido'=>false
                ],
                'num_alumnos'=>[
                    'nombre'=>"Numero de Alumnos",
                    'tipo'=>'integer',
                    'long'=>100,
                    'requerido'=>false
                ],
                'Salon'=>[
                    'nombre'=>"Aula ",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>false
                ],
                'grupo'=>[
                    'nombre'=>"Grupo ",
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>false
                ],
                'id_profesor'=>[
                    'nombre'=>"Profesor *",
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>[],
                    'long'=>100,
                    'requerido'=>true
                ],
                'id_materia'=>[
                    'nombre'=>"Materia *",
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>[],
                    'long'=>100,
                    'requerido'=>true
                ],
                'id_ciclo'=>[
                    'nombre'=>'id_ciclo',
                    'tipo'=>'hidden',
                    'requerido'=>false
                ]     
            ]
        ],
        'users'=>[
            'name'=>'Administradores',
            'data'=>[
                'id'=>[
                    'nombre'=>'id',
                    'tipo'=>'hidden',
                    'requerido'=>false
                ],
                'name'=>[
                    'nombre'=>'Nombre Completo *',
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'email'=>[
                    'nombre'=>'email Electrónico *',
                    'tipo'=>'email',
                    'long'=>100,
                    'requerido'=>true
                ],
                'password'=>[
                    'nombre'=>'Password *',
                    'tipo'=>'password',
                    'long'=>100,
                    'requerido'=>true
                ],
   
            ]
        ],
        'informes'=>[
            'name'=>'Interesados',
            'data'=>[
                'id'=>[
                    'nombre'=>'id',
                    'tipo'=>'hidden',
                    'requerido'=>false
                ],
                'nombre'=>[
                    'nombre'=>'Nombre *',
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                 'ape_paterno'=>[
                    'nombre'=>'Apellido Paterno *',
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                 'ape_materno'=>[
                    'nombre'=>'Apellido Materno *',
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                'tel_movil'=>[
                    'nombre'=>'Teléfono de Contacto',
                    'tipo'=>'phone',
                    'long'=>10,
                    'requerido'=>false
                ],
                'sexo'=>[
                    'nombre'=>'Género *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Masculino','Femenino'],
                    'long'=>100,
                    'requerido'=>true
                ],
                'curp'=>[
                    'nombre'=>"curp *",
                    'tipo'=>'string',
                    'long'=>18,
                    'requerido'=>true
                ],
                'fecha_nac'=>[
                    'nombre'=>'Fecha de Nacimiento',
                    'tipo'=>'date',
                    'long'=>100,
                    'requerido'=>false
                ],
                'edad'=>[
                    'nombre'=>'Edad *',
                    'tipo'=>'integer',
                    'long'=>100,
                    'requerido'=>true
                ],
                
            ]
        ],'archivos'=>[
            'name'=>'Archivos',
            'data'=>[
                'curp'=>[
                    'nombre'=>"curp *",
                    'tipo'=>'string',
                    'long'=>255,
                    'requerido'=>true
                ],
                'Acta_Nacimiento'=>[
                    'nombre'=>'Acta de Nacimiento *',
                    'tipo'=>'string',
                    'long'=>255,
                    'requerido'=>true
                ],
                'Comprobante_Domicilio'=>[
                    'nombre'=>'Comprobante de Domicilio *',
                    'tipo'=>'string',
                    'long'=>255,
                    'requerido'=>true
                ],
                'Certificado'=>[
                    'nombre'=>'Certificado de Ultimos Estudios *',
                    'tipo'=>'string',
                    'long'=>255,
                    'requerido'=>true
                ],
                'token'=>[
                    'nombre'=>'Llave *',
                    'tipo'=>'string',
                    'long'=>255,
                    'requerido'=>true
                ],
   
            ]
        ],
        'pre_registro'=>[
            'name'=>'Pre_Registros',
            'data'=>[
                'id_pre'=>[
                    'nombre'=>'id',
                    'tipo'=>'hidden',
                    'requerido'=>false
                ],
                'nombre'=>[
                    'nombre'=>'Nombre *',
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                 'ape_paterno'=>[
                    'nombre'=>'Apellido Paterno *',
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                ],
                 'ape_materno'=>[
                    'nombre'=>'Apellido Materno *',
                    'tipo'=>'string',
                    'long'=>100,
                    'requerido'=>true
                
                ],
                'curp'=>[
                    'nombre'=>"curp *",
                    'tipo'=>'string',
                    'long'=>255,
                    'requerido'=>true
                ],
                'email'=>[
                    'nombre'=>'email del Alumno *',
                    'tipo'=>'mail',
                    'long'=>100,
                    'requerido'=>true
                ],
                'tel_movil'=>[
                    'nombre'=>'Teléfono de Contacto',
                    'tipo'=>'phone',
                    'long'=>10,
                    'requerido'=>false
                ],
                'sexo'=>[
                    'nombre'=>'Género *',
                    'tipo'=>'select',
                    'src'=>[
                        'tipo'=>'static',
                        'id'=>'descripcion'
                    ],
                    'datos'=>['Masculino','Femenino'],
                    'long'=>100,
                    'requerido'=>true
                ],
                'fecha_nac'=>[
                    'nombre'=>'Fecha de Nacimiento',
                    'tipo'=>'date',
                    'long'=>100,
                    'requerido'=>false
                ],
                'edad'=>[
                    'nombre'=>'Edad *',
                    'tipo'=>'integer',
                    'long'=>100,
                    'requerido'=>true
                ],
                
            ]
        ]

    ];

 
    public static function obtieneDefinicionFSVTE(){ 
        //dd(\Session::get('faseActual'));
        
        $obj = new self(); 

    	return collect(SELF::FASES[\Session::get('faseActual')]['data'])->map(function($i) use($obj) {

            if($i['tipo'] == 'select'){
                switch($i['src']['tipo']){

                    case 'mule':

                        if(!isset($i['src']['id'])) $i['src']['id'] = 'descripcion';
                        $i['datos'] = $obj->obtieneCatalogo($i['src']['type'],$i['src']['method'],$i['src']['port'],$i['src']['parameters'],$i['src']['id'],$i['src']['name']);

                        break;
                    case 'dynamic':
                        $i['datos'] = ['Datos no cargados'];
                        break;
                    case 'static':
                            
                            $i['datos'] = collect($i['datos'])->flatMap(function($i){
                                return [$i=>$i];
                            });
                            //dd($i['datos']);
                        break;
                }
            }
            return $i;
        });
    }


    public static function obtieneDetalleFSVTE($fase,$variable){
        $obj = new self();
        return collect(SELF::FASES[$fase]['data'][$variable]['detalle'])->map(function($i) use($obj){

            if(isset($i['src'])){
                switch($i['src']['tipo']){
                    case 'mule':
                        if(!isset($i['src']['id'])) $i['src']['id'] = 'descripcion';
                        $i['datos'] = $obj->obtieneCatalogo($i['src']['type'],$i['src']['method'],$i['src']['port'],$i['src']['parameters'],$i['src']['id']);
                        break;
                    case 'dynamic':
                        $i['datos'] = ['Datos no cargados'];
                        break;
                    case 'static':
                        if(!isset($i['src']['id']) || $i['src']['id'] == 'descripcion'){
                            $i['datos'] = collect($i['datos'])->flatMap(function($j){
                                return [$j=>$j];
                            });
                        }
                        break;
                }
                return $i;
            }else{
                return $i;
            }
        });
    }

    private function obtieneCatalogo($type,$method,$port,$parameters,$id,$name){
        $util = new \App\Http\Controllers\Utilidades();

        $parametros = ['data'=>$parameters];

        if(isset($parametros['data']['valores']['anio'])){  
            $parametros['data']['valores']['anio'] = (int)eval('return '.$parametros['data']['valores']['anio'] .';' );
        }

        $retorno = $util->muleConnection($type,$method,$port,$parametros);
        
        $array=[];
        foreach ($retorno['Datos'] as $key => $value) {
            
                if(isset($value['activo']) && $value['activo']){
                    $array[$value[$id]]=$value[$name];
                }
                else{
                    $array[$value[$id]]=$value[$name];
                }
            
        }

        return $array;

    }

    public static function obtieneDatoCatalogo($type,$method,$port,$parameters,$id){
        $static = new Self();
        $datos = $static->obtieneCatalogo($type,$method,$port,$parameters,$id);
        return $datos;
    }
}
