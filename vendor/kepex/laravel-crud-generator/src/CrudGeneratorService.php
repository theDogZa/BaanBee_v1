<?php

namespace CrudGenerator;


use Illuminate\Console\Command;
use DB;
use Artisan;

class CrudGeneratorService
{

    public $modelName = '';
    public $tableName = '';
    public $prefix = '';
    public $force = false;
    public $layout = '';
    public $existingModel = '';
    public $controllerName = '';
    public $viewFolderName = '';
    public $output = null;
    public $appNamespace = 'App';


    public function __construct()
    {

    }


    public function Generate()
    {
        $modelname = ucfirst(str_singular($this->modelName));
        //$ModelNameUcwords = str_plural(str_replace(" ", "", (ucwords(str_replace("_", " ", $modelname)))));
        $this->viewFolderName = strtolower($this->controllerName);
        //$this->viewFolderName = $ModelNameUcwords;
        //$this->controllerName = $ModelNameUcwords;
        
        //--------f folder Module
        // if($this->folderModule){ 
        //     $this->folderModuleName = $this->folderModule."/";
        // }else{
        //     $this->folderModuleName = '';
        // };
        // $this->output->info($this->folderModuleName.$this->controllerName);
        // die;

        $this->output->info('');
        $this->output->info('Creating catalogue for table: '.($this->tableName ?: strtolower(str_plural($this->modelName))));
        $this->output->info('Model Name: '.$modelname);

        $options = [
            'model_name' => str_replace("_", " ", $modelname),
            'model_name_plural' => str_plural(str_replace("_", " ", $modelname)),
            'model_uc' => $modelname,
            'model_uc_plural' => str_plural($modelname),
            'model_singular' => strtolower($modelname),
            'model_plural' => strtolower(str_plural($modelname)),
            'tablename' => $this->tableName ?: strtolower(str_plural($this->modelName)),
            'prefix' => $this->prefix,
            'custom_master' => $this->layout ?: 'crudgenerator::layouts.master',
            'controller_name' => $this->controllerName,
            'view_folder' => $this->viewFolderName,
            'route_path' => $this->viewFolderName,
            'appns' => $this->appNamespace,
        ];
     
        if(!$this->force) {
            //if(file_exists(app_path().'/'.$modelname.'.php')) { $this->output->info('Model already exists, use --force to overwrite'); return; }
            if(file_exists(app_path().'/Models/'.$modelname.'.php')) { $this->output->info('Model already exists, use --force to overwrite'); return; }
            if(file_exists(app_path().'/Http/Controllers/'.$this->controllerName.'Controller.php')) { $this->output->info('Controller already exists, use --force to overwrite'); return; }
            if(file_exists(base_path().'/resources/views/'.$this->viewFolderName.'/add.blade.php')) { $this->output->info('Add view already exists, use --force to overwrite'); return; }
            if(file_exists(base_path().'/resources/views/'.$this->viewFolderName.'/show.blade.php')) { $this->output->info('Show view already exists, use --force to overwrite'); return; }
            if(file_exists(base_path().'/resources/views/'.$this->viewFolderName.'/index.blade.php')) { $this->output->info('Index view already exists, use --force to overwrite');  return; }
            if(file_exists(base_path().'/resources/lang/en/'.strtolower($modelname).'.php')) { $this->output->info('Lang (en) already exists, use --force to overwrite');  return; }
            if(file_exists(base_path().'/resources/lang/th/'.strtolower($modelname).'.php')) {$this->output->info('Lang (th) already exists, use --force to overwrite'); return; }
        }


        //$columns = $this->createModel($modelname, $this->prefix, $this->tableName);
        $columns = $this->getColumns($this->prefix.($this->tableName ?: strtolower(str_plural($modelname))));

        $options['columns'] = $columns;
        $options['first_column_nonid'] = count($columns) > 1 ? $columns[1]['name'] : '';
        $options['num_columns'] = count($columns);
        
        /*  add 08021018
        by Prasong
        columns_type_xxx = to @scripts
        */
        if(array_search('select', array_column($columns, 'type')) !== false) {           
            $options['columns_type_select'] = true;
        }else{
            $options['columns_type_select'] = false;
        }

        if(array_search('datetime', array_column($columns, 'type')) !== false) {
            $options['columns_type_datetime'] = true;
        }else{
            $options['columns_type_datetime'] = false;
        }
        if($options['columns_type_datetime'] !== true){
            if(array_search('date', array_column($columns, 'type')) !== false) {  
                $options['columns_type_datetime'] = true;
            }else{
            
                $options['columns_type_datetime'] = false;
            }
        }
        if($options['columns_type_datetime'] !== true){
            if(array_search('time', array_column($columns, 'type')) !== false) {
            
                $options['columns_type_datetime'] = true;
            }else{
                $options['columns_type_datetime'] = false;
            }
        }
        if(array_search('textarea', array_column($columns, 'type')) !== false) {           
            $options['columns_type_textarea'] = true;
        }else{
            $options['columns_type_textarea'] = false;
        }
        //------------------------------------------
      
        //  print_r($options);
        /*  add 23012018
        by Prasong
        Not column =  id,updated_at,created_at,created_by,updated_by
        */

        $columns_index = $this->getColumns_index($this->prefix.($this->tableName ?: strtolower(str_plural($modelname))));

        $columns_model = $this->getColumns_Model($this->prefix.($this->tableName ?: strtolower(str_plural($modelname))));
        
        $options['columns_index'] = $columns_index;
        $options['columns_model'] = $columns_model;

        /** add 05042018 
         * 
        */
        $options['belongs'] = $this->getModelBelongs($columns, $modelname);
        $options['datetimenow'] = now();

        //  print_r($options);
        //------------------------------------------

        //###############################################################################
        if(!is_dir(base_path().'/resources/views/'.$this->viewFolderName)) {
            $this->output->info('Creating directory: '.base_path().'/resources/views/'.$this->viewFolderName);
            mkdir( base_path().'/resources/views/'.$this->viewFolderName);
        }

        $filegenerator = new \CrudGenerator\CrudGeneratorFileCreator();
        $filegenerator->options = $options;
        $filegenerator->output = $this->output;

        $filegenerator->templateName = 'model';
        $filegenerator->path = app_path().'/Models/'.$modelname.'.php';
        $filegenerator->Generate();

        $filegenerator->templateName = 'controller';
        $filegenerator->path = app_path().'/Http/Controllers/'.$this->controllerName.'Controller.php';
        $filegenerator->Generate();

        $filegenerator->templateName = 'view.add';
        $filegenerator->path = base_path().'/resources/views/'.$this->viewFolderName.'/add.blade.php';
        $filegenerator->Generate();

        $filegenerator->templateName = 'view.show';
        $filegenerator->path = base_path().'/resources/views/'.$this->viewFolderName.'/show.blade.php';
        $filegenerator->Generate();

        $filegenerator->templateName = 'view.index';
        $filegenerator->path = base_path().'/resources/views/'.$this->viewFolderName.'/index.blade.php';
        $filegenerator->Generate();

        $filegenerator->templateName = 'view.advancedsearch';
        $filegenerator->path = base_path().'/resources/views/'.$this->viewFolderName.'/advanced_search.blade.php';
        $filegenerator->Generate();

        $filegenerator->templateName = 'lang.en';
        $filegenerator->path = base_path().'/resources/lang/en/'.strtolower($modelname).'.php';
        $filegenerator->Generate();
        
        $filegenerator->templateName = 'lang.th';
        $filegenerator->path = base_path().'/resources/lang/th/'.strtolower($modelname).'.php';
        $filegenerator->Generate();
        //###############################################################################

        // $addroute = 'Route::get(\'/'.$this->viewFolderName.'/grid\', \''.$this->controllerName.'Controller@grid\');';
        // $this->appendToEndOfFile(base_path().'/routes/web.php', "\n".$addroute, 0, true);
        // $this->output->info('Adding Route: '.$addroute );


        $addroute = 'Route::resource(\'/'.$this->viewFolderName.'\', \''.$this->controllerName.'Controller\');';
        $this->appendToEndOfFile(base_path().'/routes/web.php', "\n".$addroute, 0, true);
        $this->output->info('Adding Route: '.$addroute );


    }

    protected function getColumns($tablename) {
        $dbType = DB::getDriverName();
        switch ($dbType) {
            case "pgsql":
                $cols = DB::select("select column_name as Field, "
                                . "data_type as Type, "
                                . "is_nullable as Null "
                                . "from INFORMATION_SCHEMA.COLUMNS "
                                . "where table_name = '" . $tablename . "'");
                break;
            default:
                $cols = DB::select("show columns from " . $tablename);
                break;
        }
        $ret = [];
        $notColumn = array('id', 'updated_at', 'created_at', 'created_uid', 'updated_uid');
        foreach ($cols as $c) {

            if ($c->Field!='id') {

                $field = isset($c->Field) ? $c->Field : $c->field;
            // $type = isset($c->Type) ? $c->Type : $c->type;
                $type = $this->getKeyTypeFromDBKey($c);
                $null = isset($c->Null) ? $c->Null : $c->null;
                $cadd = [];
                $cadd['name'] = $field;
                $cadd['type'] = $field == 'id' ? 'id' : $this->getTypeFromDBType($type, $field);
                $cadd['required'] = $null == 'NO' ? 'required' : '';
                $cadd['display_required'] = $null == 'NO' ? '*' : '';
                //$cadd['display'] = ucwords(str_replace('_', ' ', $field));
                $cadd['display'] = $this->getDisplayeFromDBKey($c,$field);
                $cadd['model_select'] = $this->getForeignModelDBKey($c,$tablename);

                if (!in_array($c->Field, $notColumn)) {
                    $cadd['col_show'] = 1;
                }else{
                    $cadd['col_show'] = 0;
                    $cadd['readonly'] = 'readonly';
                }

                $ret[] = $cadd;
            }
        }
       // print_r($ret);//die;
        return $ret;

    }

   /*  add 03022018
        by Prasong
        for Type select to FOREIGN KEY 
    */
    protected function getKeyTypeFromDBKey($c){
        if($c->Key == 'MUL'){
            $c->Type = 'select';
        }
       // return isset($c->Type) ? $c->Type : $c->type;
       return $c->Type;
    }

    protected function getTypeFromDBType($dbtype, $field) {

        if(str_contains($field, 'active')) {return 'radio_active';}
        if(str_contains($dbtype, 'varchar')) { return 'text'; }
        if(str_contains($dbtype, 'text'))  { return 'textarea'; }
        if(str_contains($dbtype, 'tinyint') || str_contains($dbtype, 'boolean')) { return 'radio'; }
        if(str_contains($dbtype, 'int') || str_contains($dbtype, 'float')) { return 'number'; }
        if(str_contains($dbtype, 'datetime')) { return 'datetime'; }
        if(str_contains($dbtype, 'date')) { return 'date'; }
        if(str_contains($dbtype, 'time'))  { return 'time'; }
        if(str_contains($dbtype, 'select') || str_contains($dbtype, 'year')) { return 'select'; }
        
        return 'unknown';
    }

    /*  add 03022018
        by Prasong
        for display for FOREIGN KEY 
    */
    protected function getDisplayeFromDBKey($c,$field){
        if($c->Key == 'MUL'){
            $new = substr($field,0,-2);
            return ucwords(str_replace('_', ' ', $new));
        }else{
            return ucwords(str_replace('_', ' ', $field));
        }
    }

    protected function getForeignModelDBKey($c,$tablename){
        $notColumn = array('id', 'updated_at', 'created_at', 'created_uid', 'updated_uid');
        if($c->Key == 'MUL'){
            if($c->Field != 'parent_id'){
                if (!in_array($c->Field, $notColumn)) {
                   // $new = substr($c->Field,0,-3);
                    $new = $c->Field;
                    $modelForeign = (str_replace("_id", "", $new));
                    $modelForeign = ucfirst(str_singular($modelForeign."s"));
                   
                }else{
                    $modelForeign = 'Users';
                }
            }else{
               
                $modelForeign = substr(ucwords($tablename), 0, -1);
            }

            //return substr($modelForeign,0,-1);
            return $modelForeign;
        }    
    }

    /*  add 23012018
        by Prasong
        Not column =  id,updated_at,created_at,created_by,updated_by
    */
    protected function getColumns_index($tablename) {
        $dbType = DB::getDriverName();
        switch ($dbType) {
            case "pgsql":
                $cols = DB::select("select column_name as Field, "
                                . "data_type as Type, "
                                . "is_nullable as Null "
                                . "from INFORMATION_SCHEMA.COLUMNS "
                                . "where table_name = '" . $tablename . "'");
                break;
            default:
                $cols = DB::select("show columns from " . $tablename);
                break;
        }

        $ret = [];
        $notColumn = array('id','updated_at','created_at','created_uid','updated_uid');
        foreach ($cols as $c) {
            
            if (!in_array($c->Field, $notColumn)) {

                $field = isset($c->Field) ? $c->Field : $c->field;
                //$type = isset($c->Type) ? $c->Type : $c->type;
                $type = $this->getKeyTypeFromDBKey($c);
                $null = isset($c->Null) ? $c->Null : $c->null;
                $cadd = [];
                $cadd['name'] = $field;
                $cadd['type'] = $field == 'id' ? 'id' : $this->getTypeFromDBType($type, $field);
                //$cadd['display'] = ucwords(str_replace('_', ' ', $field));
                $cadd['display'] = $this->getDisplayeFromDBKey($c,$field);
                $cadd['required'] = $null == 'NO' ? 'required' : '';
                $cadd['display_required'] = $null == 'NO' ? '*' : '';
                $cadd['model_select'] = $this->getForeignModelDBKey($c,$tablename);

                if (!in_array($c->Field, $notColumn)) {
                    $cadd['col_show'] = 1;
                    $cadd['readonly'] = '';
                } else {
                    $cadd['col_show'] = 0;
                    $cadd['readonly'] = 'readonly';
                }

                $ret[] = $cadd;
            }
        }
       
        return $ret;
    }

    /*  add 27012018
        by Prasong
        Not column =  id,updated_at,created_at,created_by,updated_by
    */
    protected function getColumns_Model($tablename) {
        $dbType = DB::getDriverName();
        switch ($dbType) {
            case "pgsql":
                $cols = DB::select("select column_name as Field, "
                                . "data_type as Type, "
                                . "is_nullable as Null "
                                . "from INFORMATION_SCHEMA.COLUMNS "
                                . "where table_name = '" . $tablename . "'");
                break;
            default:
                $cols = DB::select("show columns from " . $tablename);
                break;
        }

        //$ret = [];
        $ret='';
        $notColumn = array('id','updated_at','created_at','created_uid','updated_uid');
        foreach ($cols as $c) {
            
            if (!in_array($c->Field, $notColumn)) {

                $field = isset($c->Field) ? $c->Field : $c->field;
                
                if($ret==''){
                    $ret = "'".$field."'";
                }else{
                    $ret .= ",'".$field."'";
                }
            }
        }
        return $ret;
    }

    protected function getModelBelongs($arrColumn,$modelname)
    {
        $arrC = array();
        $arrBelongs = array();
        $i=1;
        foreach ($arrColumn as $c) {
            if (!in_array($c['model_select'], $arrC)) {
                if($c['model_select']){
                    if($c['model_select']!= $modelname){
                        $arrC[] = $c['model_select'];
                        $arrBelongs[$i]['c'] = $c['model_select'];
                       // $arrBelongs[$i]['f'] = strtolower($c['model_select']);
                        $arrBelongs[$i]['f'] = strtolower(ucfirst(str_singular($c['model_select'] . "s")));

                        $i++;
                    }
                }
            }
        }

        return $arrBelongs;
    }

    // protected function createModel($modelname, $prefix, $table_name) {

    //     Artisan::call('make:model', ['name' => $modelname]);


    //     if($table_name) {
    //         $this->output->info('Custom table name: '.$prefix.$table_name);
    //         $this->appendToEndOfFile(app_path().'/'.$modelname.'.php', "    protected \$table = '".$table_name."';\n\n}", 2);
    //     }


    //     $columns = $this->getColumns($prefix.($table_name ?: strtolower(str_plural($modelname))));

    //     $cc = collect($columns);

    //     if(!$cc->contains('name', 'updated_at') || !$cc->contains('name', 'created_at')) {
    //         $this->appendToEndOfFile(app_path().'/'.$modelname.'.php', "    public \$timestamps = false;\n\n}", 2, true);
    //     }

    //     $this->output->info('Model created, columns: '.json_encode($columns));
    //     return $columns;
    // }

    protected function deletePreviousFiles($tablename, $existing_model) {
        $todelete = [
                app_path().'/Http/Controllers/'.ucfirst($tablename).'Controller.php',
                base_path().'/resources/views/'.str_plural($tablename).'/index.blade.php',
                base_path().'/resources/views/'.str_plural($tablename).'/add.blade.php',
                base_path().'/resources/views/'.str_plural($tablename).'/show.blade.php',
                //base_path() .'/resources/views/'.str_plural($tablename) .'/show.blade.php',
            ];
        if(!$existing_model) {
            $todelete[] = app_path().'/'.ucfirst(str_singular($tablename)).'.php';
        }
        foreach($todelete as $path) {
            if(file_exists($path)) {
                unlink($path);
                $this->output->info('Deleted: '.$path);
            }
        }
    }

    protected function appendToEndOfFile($path, $text, $remove_last_chars = 0, $dont_add_if_exist = false) {
        $content = file_get_contents($path);
        if(!str_contains($content, $text) || !$dont_add_if_exist) {
            $newcontent = substr($content, 0, strlen($content)-$remove_last_chars).$text;
            file_put_contents($path, $newcontent);
        }
    }
}



/** 
 * CRUD Laravel
 * Master ฺBY Kepex  =>  https://github.com/kEpEx/laravel-crud-generator
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 06/04/2018 13:51
 * Version : v.10000
 */
