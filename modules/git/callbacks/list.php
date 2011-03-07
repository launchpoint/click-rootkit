<?

$script = array();

chdir(ROOT_FPATH);

exec("find . -name '.git'", $dirs);

$status = array();
foreach($dirs as $gpath)
{
  $fpath = dirname($gpath);
  $dir = ROOT_FPATH."/{$fpath}";
  chdir($dir);
  exec("git status", $output);
  $status[$fpath] = $output;
  $output='';
  
  $script[] = "cd $dir";
  $script[] = "git commit -a -m 'Quick commit'";
}

// search for missing gits
$missing = array();
foreach(glob(GLOBAL_MODULES_FPATH."/*") as $fpath)
{
  if (file_exists($fpath."/.git")) continue;
  $repo = "click-".basename($fpath);
  $missing[] = $fpath;
  $script[] = "cd $fpath";
  $script[] = "curl -u 'launchpoint/token:b1d2a2c6cb76912ef7faa9d7b69ddeba' \"http://github.com/api/v2/xml/repos/create?name={$repo}\"";
  $script[] = "git init";
  $scriot[] = "touch README.mb";
  $script[] = "git add .";
  $script[] = "git commit -m 'Initial commit'";
  $script[] = "git remote add origin git@github.com:launchpoint/{$repo}.git";
  $scriot[] = "git push origin master";
}