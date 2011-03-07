<?

chdir(ROOT_FPATH."/{$params['path']}");
$commands = array(
  "git commit -a -m 'Quick commit'",
  "git push"
);
flash_next("Committed {$params['path']}");
foreach($commands as $c)
{
  $cmd = "echo 'lsi1224' | /usr/bin/sudo -u lsi -S $c";
  $res = exec($cmd);
  dprint($cmd);
  flash_next(join("\n",$output));
  $output="";
}
//redirect_to(list_git_url());
