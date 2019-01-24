<!-- NO_MARKDOWN_PARSING -->
<h1>App helpers</h1>
<h3 style="text-transform: uppercase; font-weight: bold">backend</h3>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_use_logrotate" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_use_logrotate</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Use logrotate to manage the logfile</h6>
    </div>
    <div id="collapse-ynh_use_logrotate" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_use_logrotate [logfile] [--non-append|--append] [specific_user/specific_group]</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>logfile</code> : absolute path of logfile</li>
            <li><code>--non-append</code> : (Option) Replace the config file instead of appending this new config.</li>
            <li><code>specific_user</code> : run logrotate as the specified user and group. If not specified logrotate is runned as root.</li>
        </ul>
    </p>
    <p>
        <strong>Details</strong>:
        <p>
        If no argument provided, a standard directory will be use. /var/log/${app}</br>You can provide a path with the directory only or with the logfile.</br>/parentdir/logdir</br>/parentdir/logdir/logfile.log</br></br>It's possible to use this helper several times, each config will be added to the same logrotate config file.</br>Unless you use the option --non-append</br></br>
        </p>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/backend#L15">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_remove_logrotate" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_remove_logrotate</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Remove the app's logrotate config.</h6>
    </div>
    <div id="collapse-ynh_remove_logrotate" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_remove_logrotate</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/backend#L68">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_add_systemd_config" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_add_systemd_config</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Create a dedicated systemd config</h6>
    </div>
    <div id="collapse-ynh_add_systemd_config" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_add_systemd_config [service] [template]</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>service</code> : Service name (optionnal, $app by default)</li>
            <li><code>template</code> : Name of template file (optionnal, this is 'systemd' by default, meaning ./conf/systemd.service will be used as template)</li>
        </ul>
    </p>
    <p>
        <strong>Details</strong>:
        <p>
        This will use the template ../conf/<templatename>.service</br>to generate a systemd config, by replacing the following keywords</br>with global variables that should be defined before calling</br>this helper :</br></br>__APP__       by  $app</br>  __FINALPATH__ by  $final_path</br></br>
        </p>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/backend#L88">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_remove_systemd_config" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_remove_systemd_config</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Remove the dedicated systemd config</h6>
    </div>
    <div id="collapse-ynh_remove_systemd_config" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_remove_systemd_config [service]</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>service</code> : Service name (optionnal, $app by default)</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/backend#L115">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_add_nginx_config" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_add_nginx_config</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Create a dedicated nginx config</h6>
    </div>
    <div id="collapse-ynh_add_nginx_config" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_add_nginx_config "list of others variables to replace"</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>list</code> : ['others', 'variables', 'to', 'replace', 'separeted', 'by', 'a', 'space']</li>
        </ul>
    </p>
    <p>
        <strong>Details</strong>:
        <p>
        This will use a template in ../conf/nginx.conf</br>  __PATH__      by  $path_url</br>  __DOMAIN__    by  $domain</br>  __PORT__      by  $port</br>  __NAME__      by  $app</br>  __FINALPATH__ by  $final_path</br></br>And dynamic variables (from the last example) :</br>  __PATH_2__    by $path_2</br>  __PORT_2__    by $port_2</br></br>
        </p>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/backend#L145">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_remove_nginx_config" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_remove_nginx_config</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Remove the dedicated nginx config</h6>
    </div>
    <div id="collapse-ynh_remove_nginx_config" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_remove_nginx_config</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/backend#L195">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_add_fpm_config" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_add_fpm_config</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Create a dedicated php-fpm config</h6>
    </div>
    <div id="collapse-ynh_add_fpm_config" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_add_fpm_config</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/backend#L203">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_remove_fpm_config" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_remove_fpm_config</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Remove the dedicated php-fpm config</h6>
    </div>
    <div id="collapse-ynh_remove_fpm_config" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_remove_fpm_config</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/backend#L237">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<h3 style="text-transform: uppercase; font-weight: bold">filesystem</h3>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_backup" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_backup</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Add a file or a directory to the list of paths to backup</h6>
    </div>
    <div id="collapse-ynh_backup" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code helper-usage">ynh_backup src [dest [is_big [arg]]]
the backup dir.
backup dir</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>src</code> : file or directory to bind or symlink or copy. it shouldn't be in</li>
            <li><code>dest</code> : destination file or directory inside the</li>
            <li><code>is_big</code> : 1 to indicate data are big (mail, video, image ...)</li>
            <li><code>arg</code> : Deprecated arg</li>
        </ul>
    </p>
    <p>
        <strong>Example</strong>: <code class="helper-code"># Wordpress app context</code>
    </p>
    <p>
        <strong>Details</strong>:
        <p>
        Note: this helper could be used in backup hook or in backup script inside an</br>app package</br></br>Details: ynh_backup writes SRC and the relative DEST into a CSV file. And it</br>creates the parent destination directory</br></br>If DEST is ended by a slash it complete this path with the basename of SRC.</br></br>ynh_backup "/etc/nginx/conf.d/$domain.d/$app.conf"</br># => This line will be added into CSV file</br># "/etc/nginx/conf.d/$domain.d/$app.conf","apps/wordpress/etc/nginx/conf.d/$domain.d/$app.conf"</br></br>ynh_backup "/etc/nginx/conf.d/$domain.d/$app.conf" "conf/nginx.conf"</br># => "/etc/nginx/conf.d/$domain.d/$app.conf","apps/wordpress/conf/nginx.conf"</br></br>ynh_backup "/etc/nginx/conf.d/$domain.d/$app.conf" "conf/"</br># => "/etc/nginx/conf.d/$domain.d/$app.conf","apps/wordpress/conf/$app.conf"</br></br>ynh_backup "/etc/nginx/conf.d/$domain.d/$app.conf" "conf"</br># => "/etc/nginx/conf.d/$domain.d/$app.conf","apps/wordpress/conf"</br></br>#Deprecated usages (maintained for retro-compatibility)</br>ynh_backup "/etc/nginx/conf.d/$domain.d/$app.conf" "${backup_dir}/conf/nginx.conf"</br># => "/etc/nginx/conf.d/$domain.d/$app.conf","apps/wordpress/conf/nginx.conf"</br></br>ynh_backup "/etc/nginx/conf.d/$domain.d/$app.conf" "/conf/"</br># => "/etc/nginx/conf.d/$domain.d/$app.conf","apps/wordpress/conf/$app.conf"</br></br>
        </p>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/filesystem#L44">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_restore" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_restore</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Restore all files linked to the restore hook or to the restore app script</h6>
    </div>
    <div id="collapse-ynh_restore" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_restore</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/filesystem#L139">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_restore_file" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_restore_file</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Restore a file or a directory</h6>
    </div>
    <div id="collapse-ynh_restore_file" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code helper-usage">ynh_restore_file ORIGIN_PATH [ DEST_PATH ]
to be backuped or relative path to $YNH_CWD where it is located in the backup archive
the destination will be ORIGIN_PATH or if the ORIGIN_PATH doesn't exist in
the archive, the destination will be searched into backup.csv</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>ORIGIN_PATH</code> : Path where was located the file or the directory before</li>
            <li><code>DEST_PATH</code> : Path where restore the file or the dir, if unspecified,</li>
        </ul>
    </p>
    <p>
        <strong>Example</strong>: <code class="helper-code">ynh_restore_file "/etc/nginx/conf.d/$domain.d/$app.conf" # if apps/wordpress/etc/nginx/conf.d/$domain.d/$app.conf exists, restore it into # /etc/nginx/conf.d/$domain.d/$app.conf # if no, search a correspondance in the csv (eg: conf/nginx.conf) and restore it into # /etc/nginx/conf.d/$domain.d/$app.conf</code>
    </p>
    <p>
        <strong>Details</strong>:
        <p>
        Use the registered path in backup_list by ynh_backup to restore the file at</br>the good place.</br></br>If DEST_PATH already exists and is lighter than 500 Mo, a backup will be made in</br>/home/yunohost.conf/backup/. Otherwise, the existing file is removed.</br></br># DON'T GIVE THE ARCHIVE PATH:</br>ynh_restore_file "conf/nginx.conf"</br></br>
        </p>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/filesystem#L199">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_store_file_checksum" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_store_file_checksum</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Calculate and store a file checksum into the app settings</h6>
    </div>
    <div id="collapse-ynh_store_file_checksum" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_store_file_checksum file</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>file</code> : The file on which the checksum will performed, then stored.</li>
        </ul>
    </p>
    <p>
        <strong>Details</strong>:
        <p>
        $app should be defined when calling this helper</br></br>
        </p>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/filesystem#L278">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_backup_if_checksum_is_different" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_backup_if_checksum_is_different</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Verify the checksum and backup the file if it's different
This helper is primarily meant to allow to easily backup personalised/manually
modified config files.</h6>
    </div>
    <div id="collapse-ynh_backup_if_checksum_is_different" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_backup_if_checksum_is_different file</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>file</code> : The file on which the checksum test will be perfomed.</li>
        </ul>
    </p>
    <p>
        <strong>Details</strong>:
        <p>
        $app should be defined when calling this helper</br></br>| ret: Return the name a the backup file, or nothing</br></br>
        </p>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/filesystem#L293">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_delete_file_checksum" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_delete_file_checksum</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Delete a file checksum from the app settings</h6>
    </div>
    <div id="collapse-ynh_delete_file_checksum" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_remove_file_checksum file</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>-f,</code> : - The file for which the checksum will be deleted</li>
        </ul>
    </p>
    <p>
        <strong>Details</strong>:
        <p>
        $app should be defined when calling this helper</br></br>
        </p>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/filesystem#L316">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_secure_remove" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_secure_remove</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Remove a file or a directory securely</h6>
    </div>
    <div id="collapse-ynh_secure_remove" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_secure_remove path_to_remove</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>path_to_remove</code> : File or directory to remove</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/filesystem#L331">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<h3 style="text-transform: uppercase; font-weight: bold">getopts</h3>
<h3 style="text-transform: uppercase; font-weight: bold">ip</h3>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_validate_ip" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_validate_ip</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Validate an IP address</h6>
    </div>
    <div id="collapse-ynh_validate_ip" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_validate_ip [family] [ip_address]</code>
    </p>
    <p>
        <strong>Returns</strong>: 0 for valid ip addresses, 1 otherwise
    </p>
    <p>
        <strong>Example</strong>: <code class="helper-code">ynh_validate_ip 4 111.222.333.444</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/ip#L8">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_validate_ip4" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_validate_ip4</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Validate an IPv4 address</h6>
    </div>
    <div id="collapse-ynh_validate_ip4" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_validate_ip4 <ip_address></code>
    </p>
    <p>
        <strong>Returns</strong>: 0 for valid ipv4 addresses, 1 otherwise
    </p>
    <p>
        <strong>Example</strong>: <code class="helper-code">ynh_validate_ip4 111.222.333.444</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/ip#L36">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_validate_ip6" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_validate_ip6</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Validate an IPv6 address</h6>
    </div>
    <div id="collapse-ynh_validate_ip6" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_validate_ip6 <ip_address></code>
    </p>
    <p>
        <strong>Returns</strong>: 0 for valid ipv6 addresses, 1 otherwise
    </p>
    <p>
        <strong>Example</strong>: <code class="helper-code">ynh_validate_ip6 2000:dead:beef::1</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/ip#L49">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<h3 style="text-transform: uppercase; font-weight: bold">mysql</h3>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_mysql_connect_as" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_mysql_connect_as</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Open a connection as a user</h6>
    </div>
    <div id="collapse-ynh_mysql_connect_as" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_mysql_connect_as user pwd [db]</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>user</code> : the user name to connect as</li>
            <li><code>pwd</code> : the user password</li>
            <li><code>db</code> : the database to connect to</li>
        </ul>
    </p>
    <p>
        <strong>Example</strong>: <code class="helper-code">ynh_mysql_connect_as 'user' 'pass' <<< "UPDATE ...;" example: ynh_mysql_connect_as 'user' 'pass' < /path/to/file.sql</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/mysql#L12">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_mysql_execute_as_root" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_mysql_execute_as_root</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Execute a command as root user</h6>
    </div>
    <div id="collapse-ynh_mysql_execute_as_root" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_mysql_execute_as_root sql [db]</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>sql</code> : the SQL command to execute</li>
            <li><code>db</code> : the database to connect to</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/mysql#L21">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_mysql_execute_file_as_root" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_mysql_execute_file_as_root</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Execute a command from a file as root user</h6>
    </div>
    <div id="collapse-ynh_mysql_execute_file_as_root" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_mysql_execute_file_as_root file [db]</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>file</code> : the file containing SQL commands</li>
            <li><code>db</code> : the database to connect to</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/mysql#L31">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_mysql_dump_db" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_mysql_dump_db</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Dump a database</h6>
    </div>
    <div id="collapse-ynh_mysql_dump_db" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_mysql_dump_db db</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>db</code> : the database name to dump</li>
        </ul>
    </p>
    <p>
        <strong>Returns</strong>: the mysqldump output
    </p>
    <p>
        <strong>Example</strong>: <code class="helper-code">ynh_mysql_dump_db 'roundcube' > ./dump.sql</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/mysql#L79">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_mysql_user_exists" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_mysql_user_exists</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Check if a mysql user exists</h6>
    </div>
    <div id="collapse-ynh_mysql_user_exists" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_mysql_user_exists user</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>user</code> : the user for which to check existence</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/mysql#L99">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_mysql_setup_db" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_mysql_setup_db</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Create a database, an user and its password. Then store the password in the app's config</h6>
    </div>
    <div id="collapse-ynh_mysql_setup_db" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_mysql_setup_db user name [pwd]</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>user</code> : Owner of the database</li>
            <li><code>name</code> : Name of the database</li>
            <li><code>pwd</code> : Password of the database. If not given, a password will be generated</li>
        </ul>
    </p>
    <p>
        <strong>Details</strong>:
        <p>
        After executing this helper, the password of the created database will be available in $db_pwd</br>It will also be stored as "mysqlpwd" into the app settings.</br></br>
        </p>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/mysql#L129">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_mysql_remove_db" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_mysql_remove_db</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Remove a database if it exists, and the associated user</h6>
    </div>
    <div id="collapse-ynh_mysql_remove_db" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_mysql_remove_db user name</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>user</code> : Owner of the database</li>
            <li><code>name</code> : Name of the database</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/mysql#L144">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_sanitize_dbid" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_sanitize_dbid</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Sanitize a string intended to be the name of a database
(More specifically : replace - and . by _)</h6>
    </div>
    <div id="collapse-ynh_sanitize_dbid" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_sanitize_dbid name</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>name</code> : name to correct/sanitize</li>
        </ul>
    </p>
    <p>
        <strong>Returns</strong>: the corrected name
    </p>
    <p>
        <strong>Example</strong>: <code class="helper-code">dbname=$(ynh_sanitize_dbid $app)</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/mysql#L169">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<h3 style="text-transform: uppercase; font-weight: bold">network</h3>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_normalize_url_path" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_normalize_url_path</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Normalize the url path syntax
Handle the slash at the beginning of path and its absence at ending
Return a normalized url path</h6>
    </div>
    <div id="collapse-ynh_normalize_url_path" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_normalize_url_path path_to_normalize</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>url_path_to_normalize</code> : URL path to normalize before using it</li>
        </ul>
    </p>
    <p>
        <strong>Example</strong>: <code class="helper-code">url_path=$(ynh_normalize_url_path $url_path) ynh_normalize_url_path example -> /example ynh_normalize_url_path /example -> /example ynh_normalize_url_path /example/ -> /example ynh_normalize_url_path / -> /</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/network#L13">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_find_port" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_find_port</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Find a free port and return it</h6>
    </div>
    <div id="collapse-ynh_find_port" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_find_port begin_port</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>begin_port</code> : port to start to search</li>
        </ul>
    </p>
    <p>
        <strong>Example</strong>: <code class="helper-code">port=$(ynh_find_port 8080)</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/network#L31">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_webpath_available" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_webpath_available</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Check availability of a web path</h6>
    </div>
    <div id="collapse-ynh_webpath_available" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_webpath_available domain path</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>domain</code> : the domain/host of the url</li>
            <li><code>path</code> : the web path to check the availability of</li>
        </ul>
    </p>
    <p>
        <strong>Example</strong>: <code class="helper-code">ynh_webpath_available some.domain.tld /coffee</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/network#L48">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_webpath_register" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_webpath_register</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Register/book a web path for an app</h6>
    </div>
    <div id="collapse-ynh_webpath_register" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_webpath_register app domain path</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>app</code> : the app for which the domain should be registered</li>
            <li><code>domain</code> : the domain/host of the web path</li>
            <li><code>path</code> : the web path to be registered</li>
        </ul>
    </p>
    <p>
        <strong>Example</strong>: <code class="helper-code">ynh_webpath_register wordpress some.domain.tld /coffee</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/network#L62">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<h3 style="text-transform: uppercase; font-weight: bold">nodejs</h3>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-export" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>export</tt></h5>
        <h6 class="helper-card-subtitle text-muted">N_PREFIX is the directory of n, it needs to be loaded as a environment variable.</h6>
    </div>
    <div id="collapse-export" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code"></code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/nodejs#L4">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_use_nodejs" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_use_nodejs</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Load the version of node for an app, and set variables.</h6>
    </div>
    <div id="collapse-ynh_use_nodejs" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_use_nodejs</code>
    </p>
    <p>
        <strong>Details</strong>:
        <p>
        ynh_use_nodejs has to be used in any app scripts before using node for the first time.</br></br>2 variables are available:</br>  - $nodejs_path: The absolute path of node for the chosen version.</br>  - $nodejs_version: Just the version number of node for this app. Stored as 'nodejs_version' in settings.yml.</br>And 2 alias stored in variables:</br>  - $nodejs_use_version: An old variable, not used anymore. Keep here to not break old apps</br>    NB: $PATH will contain the path to node, it has to be propagated to any other shell which needs to use it.</br>    That's means it has to be added to any systemd script.</br></br>
        </p>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/nodejs#L37">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_install_nodejs" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_install_nodejs</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Install a specific version of nodejs</h6>
    </div>
    <div id="collapse-ynh_install_nodejs" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code helper-usage">ynh_install_nodejs [nodejs_version]
       If possible, prefer to use major version number (e.g. 8 instead of 8.10.0).
       The crontab will handle the update of minor versions when needed.</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>nodejs_version</code> : Version of node to install.</li>
        </ul>
    </p>
    <p>
        <strong>Details</strong>:
        <p>
        n (Node version management) uses the PATH variable to store the path of the version of node it is going to use.</br>That's how it changes the version</br></br>ynh_install_nodejs will install the version of node provided as argument by using n.</br></br>
        </p>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/nodejs#L60">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_remove_nodejs" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_remove_nodejs</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Remove the version of node used by the app.</h6>
    </div>
    <div id="collapse-ynh_remove_nodejs" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_remove_nodejs</code>
    </p>
    <p>
        <strong>Details</strong>:
        <p>
        This helper will check if another app uses the same version of node,</br>if not, this version of node will be removed.</br>If no other app uses node, n will be also removed.</br></br>
        </p>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/nodejs#L124">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<h3 style="text-transform: uppercase; font-weight: bold">package</h3>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_package_is_installed" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_package_is_installed</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Check either a package is installed or not</h6>
    </div>
    <div id="collapse-ynh_package_is_installed" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_package_is_installed name</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>name</code> : the package name to check</li>
        </ul>
    </p>
    <p>
        <strong>Example</strong>: <code class="helper-code">ynh_package_is_installed 'yunohost' && echo "ok"</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/package#L30">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_package_version" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_package_version</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Get the version of an installed package</h6>
    </div>
    <div id="collapse-ynh_package_version" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_package_version name</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>name</code> : the package name to get version</li>
        </ul>
    </p>
    <p>
        <strong>Returns</strong>: the version or an empty string
    </p>
    <p>
        <strong>Example</strong>: <code class="helper-code">version=$(ynh_package_version 'yunohost')</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/package#L43">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_package_update" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_package_update</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Update package index files</h6>
    </div>
    <div id="collapse-ynh_package_update" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_package_update</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/package#L64">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_package_install" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_package_install</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Install package(s)</h6>
    </div>
    <div id="collapse-ynh_package_install" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_package_install name [name [...]]</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>name</code> : the package name to install</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/package#L72">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_package_remove" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_package_remove</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Remove package(s)</h6>
    </div>
    <div id="collapse-ynh_package_remove" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_package_remove name [name [...]]</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>name</code> : the package name to remove</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/package#L81">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_package_autoremove" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_package_autoremove</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Remove package(s) and their uneeded dependencies</h6>
    </div>
    <div id="collapse-ynh_package_autoremove" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_package_autoremove name [name [...]]</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>name</code> : the package name to remove</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/package#L89">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_package_autopurge" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_package_autopurge</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Purge package(s) and their uneeded dependencies</h6>
    </div>
    <div id="collapse-ynh_package_autopurge" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_package_autopurge name [name [...]]</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>name</code> : the package name to autoremove and purge</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/package#L97">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_install_app_dependencies" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_install_app_dependencies</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Define and install dependencies with a equivs control file
This helper can/should only be called once per app</h6>
    </div>
    <div id="collapse-ynh_install_app_dependencies" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code helper-usage">ynh_install_app_dependencies dep [dep [...]]
  You can give a choice between some package with this syntax : "dep1|dep2"
  Example : ynh_install_app_dependencies dep1 dep2 "dep3|dep4|dep5"
  This mean in the dependence tree : dep1 & dep2 & (dep3 | dep4 | dep5)</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>dep</code> : the package name to install in dependence</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/package#L153">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_remove_app_dependencies" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_remove_app_dependencies</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Remove fake package and its dependencies</h6>
    </div>
    <div id="collapse-ynh_remove_app_dependencies" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_remove_app_dependencies</code>
    </p>
    <p>
        <strong>Details</strong>:
        <p>
        Dependencies will removed only if no other package need them.</br></br>
        </p>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/package#L189">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<h3 style="text-transform: uppercase; font-weight: bold">print</h3>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_die" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_die</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Print a message to stderr and exit
usage: ynh_die MSG [RETCODE]</h6>
    </div>
    <div id="collapse-ynh_die" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code"></code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/print#L3">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_print_info" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_print_info</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Display a message in the 'INFO' logging category</h6>
    </div>
    <div id="collapse-ynh_print_info" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_print_info "Some message"</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/print#L11">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_print_warn" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_print_warn</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Print a warning on stderr</h6>
    </div>
    <div id="collapse-ynh_print_warn" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_print_warn "Text to print"</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>text</code> : The text to print</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/print#L44">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_print_err" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_print_err</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Print an error on stderr</h6>
    </div>
    <div id="collapse-ynh_print_err" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_print_err "Text to print"</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>text</code> : The text to print</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/print#L52">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_exec_err" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_exec_err</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Execute a command and print the result as an error</h6>
    </div>
    <div id="collapse-ynh_exec_err" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code helper-usage">ynh_exec_err command to execute
ynh_exec_err "command to execute | following command"
In case of use of pipes, you have to use double quotes. Otherwise, this helper will be executed with the first command, then be sent to the next pipe.</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>command</code> : ['command', 'to', 'execute']</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/print#L63">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_exec_warn" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_exec_warn</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Execute a command and print the result as a warning</h6>
    </div>
    <div id="collapse-ynh_exec_warn" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code helper-usage">ynh_exec_warn command to execute
ynh_exec_warn "command to execute | following command"
In case of use of pipes, you have to use double quotes. Otherwise, this helper will be executed with the first command, then be sent to the next pipe.</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>command</code> : ['command', 'to', 'execute']</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/print#L74">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_exec_warn_less" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_exec_warn_less</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Execute a command and force the result to be printed on stdout</h6>
    </div>
    <div id="collapse-ynh_exec_warn_less" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code helper-usage">ynh_exec_warn_less command to execute
ynh_exec_warn_less "command to execute | following command"
In case of use of pipes, you have to use double quotes. Otherwise, this helper will be executed with the first command, then be sent to the next pipe.</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>command</code> : ['command', 'to', 'execute']</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/print#L85">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_exec_quiet" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_exec_quiet</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Execute a command and redirect stdout in /dev/null</h6>
    </div>
    <div id="collapse-ynh_exec_quiet" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code helper-usage">ynh_exec_quiet command to execute
ynh_exec_quiet "command to execute | following command"
In case of use of pipes, you have to use double quotes. Otherwise, this helper will be executed with the first command, then be sent to the next pipe.</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>command</code> : ['command', 'to', 'execute']</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/print#L96">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_exec_fully_quiet" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_exec_fully_quiet</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Execute a command and redirect stdout and stderr in /dev/null</h6>
    </div>
    <div id="collapse-ynh_exec_fully_quiet" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code helper-usage">ynh_exec_fully_quiet command to execute
ynh_exec_fully_quiet "command to execute | following command"
In case of use of pipes, you have to use double quotes. Otherwise, this helper will be executed with the first command, then be sent to the next pipe.</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>command</code> : ['command', 'to', 'execute']</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/print#L107">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_print_OFF" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_print_OFF</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Remove any logs for all the following commands.</h6>
    </div>
    <div id="collapse-ynh_print_OFF" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code helper-usage">ynh_print_OFF
WARNING: You should be careful with this helper, and never forget to use ynh_print_ON as soon as possible to restore the logging.</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/print#L115">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_print_ON" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_print_ON</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Restore the logging after ynh_print_OFF</h6>
    </div>
    <div id="collapse-ynh_print_ON" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_print_ON</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/print#L122">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<h3 style="text-transform: uppercase; font-weight: bold">psql</h3>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_psql_test_if_first_run" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_psql_test_if_first_run</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Create a master password and set up global settings
Please always call this script in install and restore scripts</h6>
    </div>
    <div id="collapse-ynh_psql_test_if_first_run" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_psql_test_if_first_run</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/psql#L5">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_psql_connect_as" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_psql_connect_as</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Open a connection as a user</h6>
    </div>
    <div id="collapse-ynh_psql_connect_as" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_psql_connect_as user pwd [db]</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>user</code> : the user name to connect as</li>
            <li><code>pwd</code> : the user password</li>
            <li><code>db</code> : the database to connect to</li>
        </ul>
    </p>
    <p>
        <strong>Example</strong>: <code class="helper-code">ynh_psql_connect_as 'user' 'pass' <<< "UPDATE ...;" example: ynh_psql_connect_as 'user' 'pass' < /path/to/file.sql</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/psql#L46">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_psql_execute_as_root" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_psql_execute_as_root</tt></h5>
        <h6 class="helper-card-subtitle text-muted"># Execute a command as root user</h6>
    </div>
    <div id="collapse-ynh_psql_execute_as_root" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_psql_execute_as_root sql [db]</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>sql</code> : the SQL command to execute</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/psql#L57">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_psql_execute_file_as_root" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_psql_execute_file_as_root</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Execute a command from a file as root user</h6>
    </div>
    <div id="collapse-ynh_psql_execute_file_as_root" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_psql_execute_file_as_root file [db]</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>file</code> : the file containing SQL commands</li>
            <li><code>db</code> : the database to connect to</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/psql#L67">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_psql_setup_db" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_psql_setup_db</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Create a database, an user and its password. Then store the password in the app's config</h6>
    </div>
    <div id="collapse-ynh_psql_setup_db" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_psql_setup_db user name [pwd]</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>user</code> : Owner of the database</li>
            <li><code>name</code> : Name of the database</li>
            <li><code>pwd</code> : Password of the database. If not given, a password will be generated</li>
        </ul>
    </p>
    <p>
        <strong>Details</strong>:
        <p>
        After executing this helper, the password of the created database will be available in $db_pwd</br>It will also be stored as "psqlpwd" into the app settings.</br></br>
        </p>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/psql#L82">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_psql_create_db" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_psql_create_db</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Create a database and grant privilegies to a user</h6>
    </div>
    <div id="collapse-ynh_psql_create_db" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_psql_create_db db [user [pwd]]</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>db</code> : the database name to create</li>
            <li><code>user</code> : the user to grant privilegies</li>
            <li><code>pwd</code> : the user password</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/psql#L98">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_psql_remove_db" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_psql_remove_db</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Drop a database</h6>
    </div>
    <div id="collapse-ynh_psql_remove_db" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_psql_drop_db db</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>db</code> : the database name to drop</li>
            <li><code>user</code> : the user to drop</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/psql#L111">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_psql_dump_db" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_psql_dump_db</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Dump a database</h6>
    </div>
    <div id="collapse-ynh_psql_dump_db" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_psql_dump_db db</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>db</code> : the database name to dump</li>
        </ul>
    </p>
    <p>
        <strong>Returns</strong>: the psqldump output
    </p>
    <p>
        <strong>Example</strong>: <code class="helper-code">ynh_psql_dump_db 'roundcube' > ./dump.sql</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/psql#L125">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_psql_create_user" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_psql_create_user</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Create a user</h6>
    </div>
    <div id="collapse-ynh_psql_create_user" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_psql_create_user user pwd [host]</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>user</code> : the user name to create</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/psql#L135">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_psql_drop_user" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_psql_drop_user</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Drop a user</h6>
    </div>
    <div id="collapse-ynh_psql_drop_user" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_psql_drop_user user</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>user</code> : the user name to drop</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/psql#L145">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<h3 style="text-transform: uppercase; font-weight: bold">setting</h3>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_app_setting_get" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_app_setting_get</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Get an application setting</h6>
    </div>
    <div id="collapse-ynh_app_setting_get" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_app_setting_get app key</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>app</code> : the application id</li>
            <li><code>key</code> : the setting to get</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/setting#L6">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_app_setting_set" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_app_setting_set</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Set an application setting</h6>
    </div>
    <div id="collapse-ynh_app_setting_set" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_app_setting_set app key value</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>app</code> : the application id</li>
            <li><code>key</code> : the setting name to set</li>
            <li><code>value</code> : the setting value to set</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/setting#L16">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_app_setting_delete" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_app_setting_delete</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Delete an application setting</h6>
    </div>
    <div id="collapse-ynh_app_setting_delete" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_app_setting_delete app key</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>app</code> : the application id</li>
            <li><code>key</code> : the setting to delete</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/setting#L25">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<h3 style="text-transform: uppercase; font-weight: bold">string</h3>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_string_random" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_string_random</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Generate a random string</h6>
    </div>
    <div id="collapse-ynh_string_random" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_string_random [length]</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>length</code> : the string length to generate (default: 24)</li>
        </ul>
    </p>
    <p>
        <strong>Example</strong>: <code class="helper-code">pwd=$(ynh_string_random 8)</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/string#L7">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_replace_string" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_replace_string</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Substitute/replace a string (or expression) by another in a file</h6>
    </div>
    <div id="collapse-ynh_replace_string" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_replace_string match_string replace_string target_file</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>match_string</code> : String to be searched and replaced in the file</li>
            <li><code>replace_string</code> : String that will replace matches</li>
            <li><code>target_file</code> : File in which the string will be replaced.</li>
        </ul>
    </p>
    <p>
        <strong>Details</strong>:
        <p>
        As this helper is based on sed command, regular expressions and</br>references to sub-expressions can be used</br>(see sed manual page for more information)</br></br>
        </p>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/string#L23">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_replace_special_string" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_replace_special_string</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Substitute/replace a special string by another in a file</h6>
    </div>
    <div id="collapse-ynh_replace_special_string" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_replace_special_string match_string replace_string target_file</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>match_string</code> : String to be searched and replaced in the file</li>
            <li><code>replace_string</code> : String that will replace matches</li>
            <li><code>target_file</code> : File in which the string will be replaced.</li>
        </ul>
    </p>
    <p>
        <strong>Details</strong>:
        <p>
        This helper will use ynh_replace_string, but as you can use special</br>characters, you can't use some regular expressions and sub-expressions.</br></br>
        </p>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/string#L45">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<h3 style="text-transform: uppercase; font-weight: bold">system</h3>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_abort_if_errors" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_abort_if_errors</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Exits if an error occurs during the execution of the script.</h6>
    </div>
    <div id="collapse-ynh_abort_if_errors" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_abort_if_errors</code>
    </p>
    <p>
        <strong>Details</strong>:
        <p>
        This configure the rest of the script execution such that, if an error occurs</br>or if an empty variable is used, the execution of the script stops</br>immediately and a call to `ynh_clean_setup` is triggered if it has been</br>defined by your script.</br></br>
        </p>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/system#L44">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_get_debian_release" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_get_debian_release</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Fetch the Debian release codename</h6>
    </div>
    <div id="collapse-ynh_get_debian_release" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_get_debian_release</code>
    </p>
    <p>
        <strong>Returns</strong>: The Debian release codename (i.e. jessie, stretch, ...)
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/system#L53">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<h3 style="text-transform: uppercase; font-weight: bold">user</h3>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_user_exists" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_user_exists</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Check if a YunoHost user exists</h6>
    </div>
    <div id="collapse-ynh_user_exists" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_user_exists username</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>username</code> : the username to check</li>
        </ul>
    </p>
    <p>
        <strong>Example</strong>: <code class="helper-code">ynh_user_exists 'toto' || exit 1</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/user#L7">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_user_get_info" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_user_get_info</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Retrieve a YunoHost user information</h6>
    </div>
    <div id="collapse-ynh_user_get_info" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_user_get_info username key</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>username</code> : the username to retrieve info from</li>
            <li><code>key</code> : the key to retrieve</li>
        </ul>
    </p>
    <p>
        <strong>Returns</strong>: string - the key's value
    </p>
    <p>
        <strong>Example</strong>: <code class="helper-code">mail=$(ynh_user_get_info 'toto' 'mail')</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/user#L19">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_user_list" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_user_list</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Get the list of YunoHost users</h6>
    </div>
    <div id="collapse-ynh_user_list" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_user_list</code>
    </p>
    <p>
        <strong>Returns</strong>: string - one username per line
    </p>
    <p>
        <strong>Example</strong>: <code class="helper-code">for u in $(ynh_user_list); do ...</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/user#L29">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_system_user_exists" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_system_user_exists</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Check if a user exists on the system</h6>
    </div>
    <div id="collapse-ynh_system_user_exists" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_system_user_exists username</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>username</code> : the username to check</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/user#L38">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_system_user_create" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_system_user_create</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Create a system user</h6>
    </div>
    <div id="collapse-ynh_system_user_create" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_system_user_create user_name [home_dir]</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>user_name</code> : Name of the system user that will be create</li>
            <li><code>home_dir</code> : Path of the home dir for the user. Usually the final path of the app. If this argument is omitted, the user will be created without home</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/user#L47">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_system_user_delete" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_system_user_delete</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Delete a system user</h6>
    </div>
    <div id="collapse-ynh_system_user_delete" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_system_user_delete user_name</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>user_name</code> : Name of the system user that will be create</li>
        </ul>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/user#L63">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<h3 style="text-transform: uppercase; font-weight: bold">utils</h3>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_get_plain_key" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_get_plain_key</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Extract a key from a plain command output</h6>
    </div>
    <div id="collapse-ynh_get_plain_key" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_get_plain_key key [subkey [subsubkey ...]]</code>
    </p>
    <p>
        <strong>Returns</strong>: string - the key's value
    </p>
    <p>
        <strong>Example</strong>: <code class="helper-code">yunohost user info tata --output-as plain | ynh_get_plain_key mail</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/utils#L7">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_restore_upgradebackup" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_restore_upgradebackup</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Restore a previous backup if the upgrade process failed</h6>
    </div>
    <div id="collapse-ynh_restore_upgradebackup" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code helper-usage">ynh_backup_before_upgrade
ynh_clean_setup () {
    ynh_restore_upgradebackup
}
ynh_abort_if_errors</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/utils#L37">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_backup_before_upgrade" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_backup_before_upgrade</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Make a backup in case of failed upgrade</h6>
    </div>
    <div id="collapse-ynh_backup_before_upgrade" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code helper-usage">ynh_backup_before_upgrade
ynh_clean_setup () {
    ynh_restore_upgradebackup
}
ynh_abort_if_errors</code>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/utils#L68">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_setup_source" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_setup_source</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Download, check integrity, uncompress and patch the source from app.src</h6>
    </div>
    <div id="collapse-ynh_setup_source" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_setup_source dest_dir [source_id]</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>dest_dir</code> : Directory where to setup sources</li>
            <li><code>source_id</code> : Name of the app, if the package contains more than one app</li>
        </ul>
    </p>
    <p>
        <strong>Details</strong>:
        <p>
        The file conf/app.src need to contains:</br></br>SOURCE_URL=Address to download the app archive</br>SOURCE_SUM=Control sum</br># (Optional) Program to check the integrity (sha256sum, md5sum...)</br># default: sha256</br>SOURCE_SUM_PRG=sha256</br># (Optional) Archive format</br># default: tar.gz</br>SOURCE_FORMAT=tar.gz</br># (Optional) Put false if sources are directly in the archive root</br># default: true</br>SOURCE_IN_SUBDIR=false</br># (Optionnal) Name of the local archive (offline setup support)</br># default: ${src_id}.${src_format}</br>SOURCE_FILENAME=example.tar.gz</br># (Optional) If it set as false don't extract the source.</br># (Useful to get a debian package or a python wheel.)</br># default: true</br>SOURCE_EXTRACT=(true|false)</br></br>Details:</br>This helper downloads sources from SOURCE_URL if there is no local source</br>archive in /opt/yunohost-apps-src/APP_ID/SOURCE_FILENAME</br></br>Next, it checks the integrity with "SOURCE_SUM_PRG -c --status" command.</br></br>If it's ok, the source archive will be uncompressed in $dest_dir. If the</br>SOURCE_IN_SUBDIR is true, the first level directory of the archive will be</br>removed.</br></br>Finally, patches named sources/patches/${src_id}-*.patch and extra files in</br>sources/extra_files/$src_id will be applied to dest_dir</br></br>
        </p>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/utils#L147">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_local_curl" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_local_curl</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Curl abstraction to help with POST requests to local pages (such as installation forms)</h6>
    </div>
    <div id="collapse-ynh_local_curl" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_local_curl "page_uri" "key1=value1" "key2=value2" ...</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>page_uri</code> : Path (relative to $path_url) of the page where POST data will be sent</li>
            <li><code>key1=value1</code> : (Optionnal) POST key and corresponding value</li>
            <li><code>key2=value2</code> : (Optionnal) Another POST key and corresponding value</li>
            <li><code>...</code> : (Optionnal) More POST keys and values</li>
        </ul>
    </p>
    <p>
        <strong>Example</strong>: <code class="helper-code">ynh_local_curl "/install.php?installButton" "foo=$var1" "bar=$var2"</code>
    </p>
    <p>
        <strong>Details</strong>:
        <p>
        $domain and $path_url should be defined externally (and correspond to the domain.tld and the /path (of the app?))</br></br>
        </p>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/utils#L240">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_render_template" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_render_template</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Render templates with Jinja2</h6>
    </div>
    <div id="collapse-ynh_render_template" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        <strong>Usage</strong>: <code class="helper-code">ynh_render_template some_template output_path</code>
    </p>
    <p>
        <strong>Arguments</strong>:
        <ul>
            <li><code>some_template</code> : Template file to be rendered</li>
            <li><code>output_path</code> : The path where the output will be redirected to</li>
        </ul>
    </p>
    <p>
        <strong>Details</strong>:
        <p>
        Attention : Variables should be exported before calling this helper to be</br>accessible inside templates.</br></br>
        </p>
    </p>
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/utils#L272">Dude, show me the code !</a>
    </p>
  </div>
  </div>
</div>
<style>
/*=================================================
 Helper card
=================================================*/
.helper-card {
    width:100%;
    min-height: 1px;
    margin-right: 10px;
    margin-left: 10px;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: 0.5rem;
    word-wrap: break-word;
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
}
.helper-card-body {
    padding: 1.25rem;
    padding-top: 0.8rem;
    padding-bottom: 0;
}
.helper-code {
    word-wrap: break-word;
    white-space: normal;
}
/*===============================================*/
</style>
