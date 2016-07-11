$route->get('/{{model_lower}}/', ['App\Controller\Admin\{{model}}\Home', 'get'])->setName('{{model_lower}}');

$route->get('/{{model_lower}}/add/', ['App\Controller\Admin\{{model}}\Add', 'get'])->setName('add{{model_lower}}');
$route->post('/{{model_lower}}/add/', ['App\Controller\Admin\{{model}}\Add', 'post']);

$route->get('/{{model_lower}}/edit/{id:[0-9]+}/', ['App\Controller\Admin\{{model}}\Edit', 'get'])->setName('edit{{model_lower}}');
$route->post('/{{model_lower}}/edit/{id:[0-9]+}/', ['App\Controller\Admin\{{model}}\Edit', 'post']);

$route->get('/{{model_lower}}/delete/{id:[0-9]+}/', ['App\Controller\Admin\{{model}}\Delete', 'get'])->setName('delete{{model_lower}}');
$route->delete('/{{model_lower}}/delete/{id:[0-9]+}/', ['App\Controller\Admin\{{model}}\Delete', 'post']);