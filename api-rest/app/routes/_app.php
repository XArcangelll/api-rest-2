<?php

app()->get('/alumnos','AlumnosController@index');

app()->get('/alumnos/{id}','AlumnosController@consultar');

app()->post('/alumnos','AlumnosController@agregar');

app()->delete('/alumnos/{id}','AlumnosController@borrar');

app()->put('/alumnos/{id}','AlumnosController@actualizar');

