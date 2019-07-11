<!-- NO_MARKDOWN_PARSING -->

<h1>App helpers</h1>



<h3 style="text-transform: uppercase; font-weight: bold">apt</h3>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_package_is_installed" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_package_is_installed</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Check either a package is installed or not</h6>
    </div>
    <div id="collapse-ynh_package_is_installed" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_package_is_installed --package=name</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-p</code>, <code>--package</code> : the package name to check</li>
            
            
        </ul>
    </p>
    
    
    
    <p>
        <strong>Example</strong>: <code class="helper-code">ynh_package_is_installed --package=yunohost && echo "ok"</code>
    </p>
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.2.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/apt#L51">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_package_version --package=name</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-p</code>, <code>--package</code> : the package name to get version</li>
            
            
        </ul>
    </p>
    
    
    <p>
        <strong>Returns</strong>: the version or an empty string
    </p>
    
    
    <p>
        <strong>Example</strong>: <code class="helper-code">version=$(ynh_package_version --package=yunohost)</code>
    </p>
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.2.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/apt#L73">Dude, show me the code !</a>
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
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.2.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/apt#L105">Dude, show me the code !</a>
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
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.2.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/apt#L115">Dude, show me the code !</a>
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
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.2.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/apt#L126">Dude, show me the code !</a>
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
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.2.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/apt#L136">Dude, show me the code !</a>
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
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.7.2 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/apt#L146">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_install_app_dependencies" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_install_app_dependencies</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Define and install dependencies with a equivs control file</h6>
    </div>
    <div id="collapse-ynh_install_app_dependencies" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_install_app_dependencies dep [dep [...]]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>dep</code> : the package name to install in dependence. Writing "dep3|dep4|dep5" can be used to specify alternatives. For example : dep1 dep2 "dep3|dep4|dep5" will require to install dep1 and dep 2 and (dep3 or dep4 or dep5).</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        This helper can/should only be called once per app</br></br>example : ynh_install_app_dependencies dep1 dep2 "dep3|dep4|dep5"</br></br>Requires YunoHost version 2.6.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/apt#L206">Dude, show me the code !</a>
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
        Dependencies will removed only if no other package need them.</br></br>Requires YunoHost version 2.6.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/apt#L244">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>




<h3 style="text-transform: uppercase; font-weight: bold">backup</h3>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_backup" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_backup</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Add a file or a directory to the list of paths to backup</h6>
    </div>
    <div id="collapse-ynh_backup" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_backup --src_path=src_path [--dest_path=dest_path] [--is_big] [--not_mandatory]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-s</code>, <code>--src_path</code> : file or directory to bind or symlink or copy. it shouldn't be in the backup dir.</li>
            
            
            
            <li><code>-d</code>, <code>--dest_path</code> : destination file or directory inside the backup dir</li>
            
            
            
            <li><code>-b</code>, <code>--is_big</code> : Indicate data are big (mail, video, image ...)</li>
            
            
            
            <li><code>-m</code>, <code>--not_mandatory</code> : Indicate that if the file is missing, the backup can ignore it.</li>
            
            
            
            <li><code>arg</code> : Deprecated arg</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        This helper can be used both in a system backup hook, and in an app backup script</br></br>Details: ynh_backup writes SRC and the relative DEST into a CSV file. And it</br>creates the parent destination directory</br></br>If DEST is ended by a slash it complete this path with the basename of SRC.</br></br>Example in the context of a wordpress app</br></br>ynh_backup "/etc/nginx/conf.d/$domain.d/$app.conf"</br># => This line will be added into CSV file</br># "/etc/nginx/conf.d/$domain.d/$app.conf","apps/wordpress/etc/nginx/conf.d/$domain.d/$app.conf"</br></br>ynh_backup "/etc/nginx/conf.d/$domain.d/$app.conf" "conf/nginx.conf"</br># => "/etc/nginx/conf.d/$domain.d/$app.conf","apps/wordpress/conf/nginx.conf"</br></br>ynh_backup "/etc/nginx/conf.d/$domain.d/$app.conf" "conf/"</br># => "/etc/nginx/conf.d/$domain.d/$app.conf","apps/wordpress/conf/$app.conf"</br></br>ynh_backup "/etc/nginx/conf.d/$domain.d/$app.conf" "conf"</br># => "/etc/nginx/conf.d/$domain.d/$app.conf","apps/wordpress/conf"</br></br>#Deprecated usages (maintained for retro-compatibility)</br>ynh_backup "/etc/nginx/conf.d/$domain.d/$app.conf" "${backup_dir}/conf/nginx.conf"</br># => "/etc/nginx/conf.d/$domain.d/$app.conf","apps/wordpress/conf/nginx.conf"</br></br>ynh_backup "/etc/nginx/conf.d/$domain.d/$app.conf" "/conf/"</br># => "/etc/nginx/conf.d/$domain.d/$app.conf","apps/wordpress/conf/$app.conf"</br></br>Requires YunoHost version 2.4.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/backup#L44">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_restore" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_restore</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Restore all files that were previously backuped in a core backup script or app backup script</h6>
    </div>
    <div id="collapse-ynh_restore" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_restore</code>
        
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.6.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/backup#L161">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_restore_file --origin_path=origin_path [--dest_path=dest_path] [--not_mandatory]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-o</code>, <code>--origin_path</code> : Path where was located the file or the directory before to be backuped or relative path to $YNH_CWD where it is located in the backup archive</li>
            
            
            
            <li><code>-d</code>, <code>--dest_path</code> : Path where restore the file or the dir, if unspecified, the destination will be ORIGIN_PATH or if the ORIGIN_PATH doesn't exist in the archive, the destination will be searched into backup.csv</li>
            
            
            
            <li><code>-m</code>, <code>--not_mandatory</code> : Indicate that if the file is missing, the restore process can ignore it.</li>
            
            
        </ul>
    </p>
    
    
    
    
    <p>
    <strong>Examples</strong>:<ul>
        
            
            <code class="helper-code">    ynh_restore_file "/etc/nginx/conf.d/$domain.d/$app.conf"</code>
            
            <br>
        
            
            You can also use relative paths:
            
            <br>
        
            
            <code class="helper-code">    ynh_restore_file "conf/nginx.conf"</code>
            
            <br>
        
        </ul>
    </p>
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Use the registered path in backup_list by ynh_backup to restore the file at</br>the right place.</br></br>If DEST_PATH already exists and is lighter than 500 Mo, a backup will be made in</br>/home/yunohost.conf/backup/. Otherwise, the existing file is removed.</br></br>if apps/wordpress/etc/nginx/conf.d/$domain.d/$app.conf exists, restore it into</br>/etc/nginx/conf.d/$domain.d/$app.conf</br>if no, search for a match in the csv (eg: conf/nginx.conf) and restore it into</br>/etc/nginx/conf.d/$domain.d/$app.conf</br></br>Requires YunoHost version 2.6.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/backup#L220">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_store_file_checksum --file=file</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-f</code>, <code>--file</code> : The file on which the checksum will performed, then stored.</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        $app should be defined when calling this helper</br></br>Requires YunoHost version 2.6.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/backup#L296">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_backup_if_checksum_is_different" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_backup_if_checksum_is_different</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Verify the checksum and backup the file if it's different</h6>
    </div>
    <div id="collapse-ynh_backup_if_checksum_is_different" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_backup_if_checksum_is_different --file=file</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-f</code>, <code>--file</code> : The file on which the checksum test will be perfomed.</li>
            
            
        </ul>
    </p>
    
    
    <p>
        <strong>Returns</strong>: the name of a backup file, or nothing
    </p>
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        This helper is primarily meant to allow to easily backup personalised/manually</br>modified config files.</br></br>Requires YunoHost version 2.6.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/backup#L328">Dude, show me the code !</a>
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
            
            
            <li><code>-f</code>, <code>--file=</code> : The file for which the checksum will be deleted</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        $app should be defined when calling this helper</br></br>Requires YunoHost version 3.3.1 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/backup#L361">Dude, show me the code !</a>
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
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.7.2 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/backup#L383">Dude, show me the code !</a>
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
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.7.2 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/backup#L432">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>




<h3 style="text-transform: uppercase; font-weight: bold">fail2ban</h3>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_add_fail2ban_config" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_add_fail2ban_config</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Create a dedicated fail2ban config (jail and filter conf files)</h6>
    </div>
    <div id="collapse-ynh_add_fail2ban_config" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code helper-usage">1: ynh_add_fail2ban_config --logpath=log_file --failregex=filter [--max_retry=max_retry] [--ports=ports]
2: ynh_add_fail2ban_config --use_template [--others_var="list of others variables to replace"]
|                           for example : 'var_1 var_2 ...'</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-l</code>, <code>--logpath=</code> : Log file to be checked by fail2ban</li>
            
            
            
            <li><code>-r</code>, <code>--failregex=</code> : Failregex to be looked for by fail2ban</li>
            
            
            
            <li><code>-m</code>, <code>--max_retry=</code> : Maximum number of retries allowed before banning IP address - default: 3</li>
            
            
            
            <li><code>-p</code>, <code>--ports=</code> : Ports blocked for a banned IP address - default: http,https</li>
            
            
            
            <li><code>-t</code>, <code>--use_template</code> : Use this helper in template mode</li>
            
            
            
            <li><code>-v</code>, <code>--others_var=</code> : List of others variables to replace separeted by a space</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        -----------------------------------------------------------------------------</br></br>This will use a template in ../conf/f2b_jail.conf and ../conf/f2b_filter.conf</br>  __APP__      by  $app</br></br>You can dynamically replace others variables by example :</br>  __VAR_1__    by $var_1</br>  __VAR_2__    by $var_2</br></br>Generally your template will look like that by example (for synapse):</br></br>f2b_jail.conf:</br>    [__APP__]</br>    enabled = true</br>    port = http,https</br>    filter = __APP__</br>    logpath = /var/log/__APP__/logfile.log</br>    maxretry = 3</br></br>f2b_filter.conf:</br>    [INCLUDES]</br>    before = common.conf</br>    [Definition]</br></br># Part of regex definition (just used to make more easy to make the global regex)</br>    __synapse_start_line = .? \- synapse\..+ \-</br></br># Regex definition.</br>   failregex = ^%(__synapse_start_line)s INFO \- POST\-(\d+)\- <HOST> \- \d+ \- Received request\: POST /_matrix/client/r0/login\??<SKIPLINES>%(__synapse_start_line)s INFO \- POST\-\1\- Got login request with identifier: \{u'type': u'm.id.user', u'user'\: u'(.+?)'\}, medium\: None, address: None, user\: u'\5'<SKIPLINES>%(__synapse_start_line)s WARNING \- \- (Attempted to login as @\5\:.+ but they do not exist|Failed password login for user @\5\:.+)$</br></br>ignoreregex =</br></br>-----------------------------------------------------------------------------</br></br>Note about the "failregex" option:</br>         regex to match the password failure messages in the logfile. The</br>         host must be matched by a group named "host". The tag "<HOST>" can</br>         be used for standard IP/hostname matching and is only an alias for</br>         (?:::f{4,6}:)?(?P<host>[\w\-.^_]+)</br></br>You can find some more explainations about how to make a regex here :</br>         https://www.fail2ban.org/wiki/index.php/MANUAL_0_8#Filters</br></br>Note that the logfile need to exist before to call this helper !!</br></br>To validate your regex you can test with this command:</br>fail2ban-regex /var/log/YOUR_LOG_FILE_PATH /etc/fail2ban/filter.d/YOUR_APP.conf</br></br>Requires YunoHost version 3.5.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/fail2ban#L65">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_remove_fail2ban_config" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_remove_fail2ban_config</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Remove the dedicated fail2ban config (jail and filter conf files)</h6>
    </div>
    <div id="collapse-ynh_remove_fail2ban_config" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_remove_fail2ban_config</code>
        
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 3.5.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/fail2ban#L147">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>




<h3 style="text-transform: uppercase; font-weight: bold">getopts</h3>




<h3 style="text-transform: uppercase; font-weight: bold">logging</h3>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_die" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_die</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Print a message to stderr and exit</h6>
    </div>
    <div id="collapse-ynh_die" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_die --message=MSG [--ret_code=RETCODE]</code>
        
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.4.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/logging#L8">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_print_info --message="Some message"</code>
        
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 3.2.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/logging#L26">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_print_warn --message="Text to print"</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-m</code>, <code>--message</code> : The text to print</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 3.2.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/logging#L71">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_print_err --message="Text to print"</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-m</code>, <code>--message</code> : The text to print</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 3.2.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/logging#L88">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code helper-usage">ynh_exec_err your_command
ynh_exec_err "your_command | other_command"</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>command</code> : command to execute</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        When using pipes, double quotes are required - otherwise, this helper will run the first command, and the whole output will be sent through the next pipe.</br></br>If the command to execute uses double quotes, they have to be escaped or they will be interpreted and removed.</br></br>Requires YunoHost version 3.2.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/logging#L111">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code helper-usage">ynh_exec_warn your_command
ynh_exec_warn "your_command | other_command"</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>command</code> : command to execute</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        When using pipes, double quotes are required - otherwise, this helper will run the first command, and the whole output will be sent through the next pipe.</br></br>If the command to execute uses double quotes, they have to be escaped or they will be interpreted and removed.</br></br>Requires YunoHost version 3.2.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/logging#L127">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code helper-usage">ynh_exec_warn_less your_command
ynh_exec_warn_less "your_command | other_command"</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>command</code> : command to execute</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        When using pipes, double quotes are required - otherwise, this helper will run the first command, and the whole output will be sent through the next pipe.</br></br>If the command to execute uses double quotes, they have to be escaped or they will be interpreted and removed.</br></br>Requires YunoHost version 3.2.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/logging#L143">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code helper-usage">ynh_exec_quiet your_command
ynh_exec_quiet "your_command | other_command"</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>command</code> : command to execute</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        When using pipes, double quotes are required - otherwise, this helper will run the first command, and the whole output will be sent through the next pipe.</br></br>If the command to execute uses double quotes, they have to be escaped or they will be interpreted and removed.</br></br>Requires YunoHost version 3.2.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/logging#L159">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code helper-usage">ynh_exec_fully_quiet your_command
ynh_exec_fully_quiet "your_command | other_command"</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>command</code> : command to execute</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        When using pipes, double quotes are required - otherwise, this helper will run the first command, and the whole output will be sent through the next pipe.</br></br>If the command to execute uses double quotes, they have to be escaped or they will be interpreted and removed.</br></br>Requires YunoHost version 3.2.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/logging#L175">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_print_OFF</code>
        
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        WARNING: You should be careful with this helper, and never forget to use ynh_print_ON as soon as possible to restore the logging.</br></br>Requires YunoHost version 3.2.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/logging#L186">Dude, show me the code !</a>
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
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 3.2.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/logging#L195">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_script_progression" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_script_progression</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Print a message as INFO and show progression during an app script</h6>
    </div>
    <div id="collapse-ynh_script_progression" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code helper-usage">ynh_script_progression --message=message [--weight=weight] [--time]
The execution time is given for the duration since the previous call. So the weight should be applied to this previous call.</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-m</code>, <code>--message=</code> : The text to print</li>
            
            
            
            <li><code>-w</code>, <code>--weight=</code> : The weight for this progression. This value is 1 by default. Use a bigger value for a longer part of the script.</li>
            
            
            
            <li><code>-t</code>, <code>--time=</code> : Print the execution time since the last call to this helper. Especially usefull to define weights.</li>
            
            
            
            <li><code>-l</code>, <code>--last=</code> : Use for the last call of the helper, to fill te progression bar.</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 3.5.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/logging#L224">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_return" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_return</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Return data to the Yunohost core for later processing
(to be used by special hooks like app config panel and core diagnosis)</h6>
    </div>
    <div id="collapse-ynh_return" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_return somedata</code>
        
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 3.6.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/logging#L308">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_debug" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_debug</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Debugger for app packagers</h6>
    </div>
    <div id="collapse-ynh_debug" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_debug [--message=message] [--trace=1/0]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-m</code>, <code>--message=</code> : The text to print</li>
            
            
            
            <li><code>-t</code>, <code>--trace=</code> : Turn on or off the trace of the script. Usefull to trace nonly a small part of a script.</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 3.5.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/logging#L319">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_debug_exec" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_debug_exec</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Execute a command and print the result as debug</h6>
    </div>
    <div id="collapse-ynh_debug_exec" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code helper-usage">ynh_debug_exec your_command
ynh_debug_exec "your_command | other_command"</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>command</code> : command to execute</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        When using pipes, double quotes are required - otherwise, this helper will run the first command, and the whole output will be sent through the next pipe.</br></br>If the command to execute uses double quotes, they have to be escaped or they will be interpreted and removed.</br></br>Requires YunoHost version 3.5.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/logging#L377">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>




<h3 style="text-transform: uppercase; font-weight: bold">logrotate</h3>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_use_logrotate" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_use_logrotate</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Use logrotate to manage the logfile</h6>
    </div>
    <div id="collapse-ynh_use_logrotate" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_use_logrotate [--logfile=/log/file] [--nonappend] [--specific_user=user/group]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-l</code>, <code>--logfile</code> : absolute path of logfile</li>
            
            
            
            <li><code>-n</code>, <code>--nonappend</code> : (optional) Replace the config file instead of appending this new config.</li>
            
            
            
            <li><code>-u</code>, <code>--specific_user</code> : run logrotate as the specified user and group. If not specified logrotate is runned as root.</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        If no --logfile is provided, /var/log/${app} will be used as default.</br>logfile can be just a directory, or a full path to a logfile :</br>/parentdir/logdir</br>/parentdir/logdir/logfile.log</br></br>It's possible to use this helper multiple times, each config will be added to</br>the same logrotate config file.  Unless you use the option --non-append</br></br>Requires YunoHost version 2.6.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/logrotate#L19">Dude, show me the code !</a>
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
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.6.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/logrotate#L99">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_mysql_connect_as --user=user --password=password [--database=database]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-u</code>, <code>--user</code> : the user name to connect as</li>
            
            
            
            <li><code>-p</code>, <code>--password</code> : the user password</li>
            
            
            
            <li><code>-d</code>, <code>--database</code> : the database to connect to</li>
            
            
        </ul>
    </p>
    
    
    
    <p>
        <strong>Example</strong>: <code class="helper-code">ynh_mysql_connect_as 'user' 'pass' <<< "UPDATE ...;" example: ynh_mysql_connect_as 'user' 'pass' < /path/to/file.sql</code>
    </p>
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.2.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/mysql#L16">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_mysql_execute_as_root --sql=sql [--database=database]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-s</code>, <code>--sql</code> : the SQL command to execute</li>
            
            
            
            <li><code>-d</code>, <code>--database</code> : the database to connect to</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.2.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/mysql#L37">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_mysql_execute_file_as_root --file=file [--database=database]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-f</code>, <code>--file</code> : the file containing SQL commands</li>
            
            
            
            <li><code>-d</code>, <code>--database</code> : the database to connect to</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.2.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/mysql#L58">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_mysql_dump_db --database=database</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-d</code>, <code>--database</code> : the database name to dump</li>
            
            
        </ul>
    </p>
    
    
    <p>
        <strong>Returns</strong>: the mysqldump output
    </p>
    
    
    <p>
        <strong>Example</strong>: <code class="helper-code">ynh_mysql_dump_db 'roundcube' > ./dump.sql</code>
    </p>
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.2.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/mysql#L121">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_mysql_user_exists --user=user</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-u</code>, <code>--user</code> : the user for which to check existence</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.2.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/mysql#L152">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_mysql_setup_db --db_user=user --db_name=name [--db_pwd=pwd]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-u</code>, <code>--db_user</code> : Owner of the database</li>
            
            
            
            <li><code>-n</code>, <code>--db_name</code> : Name of the database</li>
            
            
            
            <li><code>-p</code>, <code>--db_pwd</code> : Password of the database. If not provided, a password will be generated</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        After executing this helper, the password of the created database will be available in $db_pwd</br>It will also be stored as "mysqlpwd" into the app settings.</br></br>Requires YunoHost version 2.6.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/mysql#L192">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_mysql_remove_db --db_user=user --db_name=name</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-u</code>, <code>--db_user</code> : Owner of the database</li>
            
            
            
            <li><code>-n</code>, <code>--db_name</code> : Name of the database</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.6.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/mysql#L217">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>




<h3 style="text-transform: uppercase; font-weight: bold">network</h3>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_find_port" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_find_port</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Find a free port and return it</h6>
    </div>
    <div id="collapse-ynh_find_port" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_find_port --port=begin_port</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-p</code>, <code>--port</code> : port to start to search</li>
            
            
        </ul>
    </p>
    
    
    
    <p>
        <strong>Example</strong>: <code class="helper-code">port=$(ynh_find_port --port=8080)</code>
    </p>
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.6.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/network#L11">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_validate_ip" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_validate_ip</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Validate an IP address</h6>
    </div>
    <div id="collapse-ynh_validate_ip" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_validate_ip --family=family --ip_address=ip_address</code>
        
    </p>
    
    
    <p>
        <strong>Returns</strong>: 0 for valid ip addresses, 1 otherwise
    </p>
    
    
    <p>
        <strong>Example</strong>: <code class="helper-code">ynh_validate_ip 4 111.222.333.444</code>
    </p>
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.2.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/network#L35">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_validate_ip4 --ip_address=ip_address</code>
        
    </p>
    
    
    <p>
        <strong>Returns</strong>: 0 for valid ipv4 addresses, 1 otherwise
    </p>
    
    
    <p>
        <strong>Example</strong>: <code class="helper-code">ynh_validate_ip4 111.222.333.444</code>
    </p>
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.2.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/network#L69">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_validate_ip6 --ip_address=ip_address</code>
        
    </p>
    
    
    <p>
        <strong>Returns</strong>: 0 for valid ipv6 addresses, 1 otherwise
    </p>
    
    
    <p>
        <strong>Example</strong>: <code class="helper-code">ynh_validate_ip6 2000:dead:beef::1</code>
    </p>
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.2.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/network#L90">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>




<h3 style="text-transform: uppercase; font-weight: bold">nginx</h3>



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
            
            
            <li><code>list</code> : (Optional) list of others variables to replace separated by spaces. For example : 'path_2 port_2 ...'</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        This will use a template in ../conf/nginx.conf</br>  __PATH__      by  $path_url</br>  __DOMAIN__    by  $domain</br>  __PORT__      by  $port</br>  __NAME__      by  $app</br>  __FINALPATH__ by  $final_path</br></br>And dynamic variables (from the last example) :</br>  __PATH_2__    by $path_2</br>  __PORT_2__    by $port_2</br></br>Requires YunoHost version 2.7.2 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/nginx#L21">Dude, show me the code !</a>
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
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.7.2 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/nginx#L73">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>




<h3 style="text-transform: uppercase; font-weight: bold">nodejs</h3>



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
        ynh_use_nodejs has to be used in any app scripts before using node for the first time.</br></br>2 variables are available:</br>  - $nodejs_path: The absolute path of node for the chosen version.</br>  - $nodejs_version: Just the version number of node for this app. Stored as 'nodejs_version' in settings.yml.</br>And 2 alias stored in variables:</br>  - $nodejs_use_version: An old variable, not used anymore. Keep here to not break old apps</br>    NB: $PATH will contain the path to node, it has to be propagated to any other shell which needs to use it.</br>    That's means it has to be added to any systemd script.</br></br>Requires YunoHost version 2.7.12 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/nodejs#L43">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_install_nodejs --nodejs_version=nodejs_version</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-n</code>, <code>--nodejs_version</code> : Version of node to install. When possible, your should prefer to use major version number (e.g. 8 instead of 8.10.0). The crontab will then handle the update of minor versions when needed.</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        n (Node version management) uses the PATH variable to store the path of the version of node it is going to use.</br>That's how it changes the version</br></br>ynh_install_nodejs will install the version of node provided as argument by using n.</br></br>Requires YunoHost version 2.7.12 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/nodejs#L66">Dude, show me the code !</a>
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
        This helper will check if another app uses the same version of node,</br>if not, this version of node will be removed.</br>If no other app uses node, n will be also removed.</br></br>Requires YunoHost version 2.7.12 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/nodejs#L144">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>




<h3 style="text-transform: uppercase; font-weight: bold">php</h3>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_add_fpm_config" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_add_fpm_config</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Create a dedicated php-fpm config</h6>
    </div>
    <div id="collapse-ynh_add_fpm_config" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_add_fpm_config [--phpversion=7.X]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-v</code>, <code>--phpversion</code> : Version of php to use.</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.7.2 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/php#L9">Dude, show me the code !</a>
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
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.7.2 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/php#L56">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>




<h3 style="text-transform: uppercase; font-weight: bold">postgresql</h3>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_psql_connect_as" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_psql_connect_as</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Open a connection as a user</h6>
    </div>
    <div id="collapse-ynh_psql_connect_as" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_psql_connect_as --user=user --password=password [--database=database]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-u</code>, <code>--user</code> : the user name to connect as</li>
            
            
            
            <li><code>-p</code>, <code>--password</code> : the user password</li>
            
            
            
            <li><code>-d</code>, <code>--database</code> : the database to connect to</li>
            
            
        </ul>
    </p>
    
    
    
    
    <p>
    <strong>Examples</strong>:<ul>
        
            
            <code class="helper-code">   ynh_psql_connect_as 'user' 'pass' <<< "UPDATE ...;"</code>
            
            <br>
        
            
            <code class="helper-code">   ynh_psql_connect_as 'user' 'pass' < /path/to/file.sql</code>
            
            <br>
        
        </ul>
    </p>
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 3.5.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/postgresql#L17">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_psql_execute_as_root" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_psql_execute_as_root</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Execute a command as root user</h6>
    </div>
    <div id="collapse-ynh_psql_execute_as_root" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_psql_execute_as_root --sql=sql [--database=database]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-s</code>, <code>--sql</code> : the SQL command to execute</li>
            
            
            
            <li><code>-d</code>, <code>--database</code> : the database to connect to</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 3.5.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/postgresql#L38">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_psql_execute_file_as_root --file=file [--database=database]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-f</code>, <code>--file</code> : the file containing SQL commands</li>
            
            
            
            <li><code>-d</code>, <code>--database</code> : the database to connect to</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 3.5.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/postgresql#L59">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_psql_dump_db --database=database</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-d</code>, <code>--database</code> : the database name to dump</li>
            
            
        </ul>
    </p>
    
    
    <p>
        <strong>Returns</strong>: the psqldump output
    </p>
    
    
    <p>
        <strong>Example</strong>: <code class="helper-code">ynh_psql_dump_db 'roundcube' > ./dump.sql</code>
    </p>
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 3.5.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/postgresql#L125">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_psql_user_exists" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_psql_user_exists</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Check if a psql user exists</h6>
    </div>
    <div id="collapse-ynh_psql_user_exists" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_psql_user_exists --user=user</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-u</code>, <code>--user</code> : the user for which to check existence</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/postgresql#L155">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_psql_database_exists" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_psql_database_exists</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Check if a psql database exists</h6>
    </div>
    <div id="collapse-ynh_psql_database_exists" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_psql_database_exists --database=database</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-d</code>, <code>--database</code> : the database for which to check existence</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/postgresql#L174">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_psql_setup_db --db_user=user --db_name=name [--db_pwd=pwd]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-u</code>, <code>--db_user</code> : Owner of the database</li>
            
            
            
            <li><code>-n</code>, <code>--db_name</code> : Name of the database</li>
            
            
            
            <li><code>-p</code>, <code>--db_pwd</code> : Password of the database. If not given, a password will be generated</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        After executing this helper, the password of the created database will be available in $db_pwd</br>It will also be stored as "psqlpwd" into the app settings.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/postgresql#L210">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_psql_remove_db" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_psql_remove_db</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Remove a database if it exists, and the associated user</h6>
    </div>
    <div id="collapse-ynh_psql_remove_db" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_psql_remove_db --db_user=user --db_name=name</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-u</code>, <code>--db_user</code> : Owner of the database</li>
            
            
            
            <li><code>-n</code>, <code>--db_name</code> : Name of the database</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/postgresql#L237">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



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
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/postgresql#L265">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_app_setting_get --app=app --key=key</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-a</code>, <code>--app</code> : the application id</li>
            
            
            
            <li><code>-k</code>, <code>--key</code> : the setting to get</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.2.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/setting#L10">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_app_setting_set --app=app --key=key --value=value</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-a</code>, <code>--app</code> : the application id</li>
            
            
            
            <li><code>-k</code>, <code>--key</code> : the setting name to set</li>
            
            
            
            <li><code>-v</code>, <code>--value</code> : the setting value to set</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.2.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/setting#L30">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_app_setting_delete --app=app --key=key</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-a</code>, <code>--app</code> : the application id</li>
            
            
            
            <li><code>-k</code>, <code>--key</code> : the setting to delete</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.2.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/setting#L50">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_add_skipped_uris" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_add_skipped_uris</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Add skipped_uris urls into the config</h6>
    </div>
    <div id="collapse-ynh_add_skipped_uris" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_add_skipped_uris [--appid=app] --url=url1,url2 [--regex]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-a</code>, <code>--appid</code> : the application id</li>
            
            
            
            <li><code>-u</code>, <code>--url</code> : the urls to add to the sso for this app</li>
            
            
            
            <li><code>-r</code>, <code>--regex</code> : Use the key 'skipped_regex' instead of 'skipped_uris'</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        An URL set with 'skipped_uris' key will be totally ignored by the SSO,</br>which means that the access will be public and the logged-in user information will not be passed to the app.</br></br>Requires YunoHost version 3.6.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/setting#L73">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_add_unprotected_uris" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_add_unprotected_uris</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Add unprotected_uris urls into the config</h6>
    </div>
    <div id="collapse-ynh_add_unprotected_uris" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_add_unprotected_uris [--appid=app] --url=url1,url2 [--regex]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-a</code>, <code>--appid</code> : the application id</li>
            
            
            
            <li><code>-u</code>, <code>--url</code> : the urls to add to the sso for this app</li>
            
            
            
            <li><code>-r</code>, <code>--regex</code> : Use the key 'unprotected_regex' instead of 'unprotected_uris'</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        An URL set with unprotected_uris key will be accessible publicly, but if an user is logged in,</br>his information will be accessible (through HTTP headers) to the app.</br></br>Requires YunoHost version 3.6.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/setting#L104">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_add_protected_uris" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_add_protected_uris</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Add protected_uris urls into the config</h6>
    </div>
    <div id="collapse-ynh_add_protected_uris" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_add_protected_uris [--appid=app] --url=url1,url2 [--regex]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-a</code>, <code>--appid</code> : the application id</li>
            
            
            
            <li><code>-u</code>, <code>--url</code> : the urls to add to the sso for this app</li>
            
            
            
            <li><code>-r</code>, <code>--regex</code> : Use the key 'protected_regex' instead of 'protected_uris'</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        An URL set with protected_uris will be blocked by the SSO and accessible only to authenticated and authorized users.</br></br>Requires YunoHost version 3.6.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/setting#L134">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_webpath_available --domain=domain --path_url=path</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-d</code>, <code>--domain</code> : the domain/host of the url</li>
            
            
            
            <li><code>-p</code>, <code>--path_url</code> : the web path to check the availability of</li>
            
            
        </ul>
    </p>
    
    
    
    <p>
        <strong>Example</strong>: <code class="helper-code">ynh_webpath_available --domain=some.domain.tld --path_url=/coffee</code>
    </p>
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.6.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/setting#L196">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_webpath_register --app=app --domain=domain --path_url=path</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-a</code>, <code>--app</code> : the app for which the domain should be registered</li>
            
            
            
            <li><code>-d</code>, <code>--domain</code> : the domain/host of the web path</li>
            
            
            
            <li><code>-p</code>, <code>--path_url</code> : the web path to be registered</li>
            
            
        </ul>
    </p>
    
    
    
    <p>
        <strong>Example</strong>: <code class="helper-code">ynh_webpath_register --app=wordpress --domain=some.domain.tld --path_url=/coffee</code>
    </p>
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.6.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/setting#L218">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_string_random [--length=string_length]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-l</code>, <code>--length</code> : the string length to generate (default: 24)</li>
            
            
        </ul>
    </p>
    
    
    
    <p>
        <strong>Example</strong>: <code class="helper-code">pwd=$(ynh_string_random --length=8)</code>
    </p>
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.2.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/string#L11">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_replace_string --match_string=match_string --replace_string=replace_string --target_file=target_file</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-m</code>, <code>--match_string</code> : String to be searched and replaced in the file</li>
            
            
            
            <li><code>-r</code>, <code>--replace_string</code> : String that will replace matches</li>
            
            
            
            <li><code>-f</code>, <code>--target_file</code> : File in which the string will be replaced.</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        As this helper is based on sed command, regular expressions and</br>references to sub-expressions can be used</br>(see sed manual page for more information)</br></br>Requires YunoHost version 2.6.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/string#L37">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_replace_special_string --match_string=match_string --replace_string=replace_string --target_file=target_file</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-m</code>, <code>--match_string</code> : String to be searched and replaced in the file</li>
            
            
            
            <li><code>-r</code>, <code>--replace_string</code> : String that will replace matches</li>
            
            
            
            <li><code>-t</code>, <code>--target_file</code> : File in which the string will be replaced.</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        This helper will use ynh_replace_string, but as you can use special</br>characters, you can't use some regular expressions and sub-expressions.</br></br>Requires YunoHost version 2.7.7 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/string#L66">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_sanitize_dbid --db_name=name</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-n</code>, <code>--db_name</code> : name to correct/sanitize</li>
            
            
        </ul>
    </p>
    
    
    <p>
        <strong>Returns</strong>: the corrected name
    </p>
    
    
    <p>
        <strong>Example</strong>: <code class="helper-code">dbname=$(ynh_sanitize_dbid $app)</code>
    </p>
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.2.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/string#L97">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_normalize_url_path" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_normalize_url_path</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Normalize the url path syntax</h6>
    </div>
    <div id="collapse-ynh_normalize_url_path" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_normalize_url_path --path_url=path_to_normalize</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-p</code>, <code>--path_url</code> : URL path to normalize before using it</li>
            
            
        </ul>
    </p>
    
    
    
    
    <p>
    <strong>Examples</strong>:<ul>
        
            
            <code class="helper-code">    url_path=$(ynh_normalize_url_path $url_path)</code>
            
            <br>
        
            
            <code class="helper-code">    ynh_normalize_url_path example    # -> /example</code>
            
            <br>
        
            
            <code class="helper-code">    ynh_normalize_url_path /example   # -> /example</code>
            
            <br>
        
            
            <code class="helper-code">    ynh_normalize_url_path /example/  # -> /example</code>
            
            <br>
        
            
            <code class="helper-code">    ynh_normalize_url_path /          # -> /</code>
            
            <br>
        
        </ul>
    </p>
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Handle the slash at the beginning of path and its absence at ending</br>Return a normalized url path</br></br>Requires YunoHost version 2.6.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/string#L125">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>




<h3 style="text-transform: uppercase; font-weight: bold">systemd</h3>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_add_systemd_config" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_add_systemd_config</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Create a dedicated systemd config</h6>
    </div>
    <div id="collapse-ynh_add_systemd_config" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_add_systemd_config [--service=service] [--template=template]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-s</code>, <code>--service</code> : Service name (optionnal, $app by default)</li>
            
            
            
            <li><code>-t</code>, <code>--template</code> : Name of template file (optionnal, this is 'systemd' by default, meaning ./conf/systemd.service will be used as template)</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        This will use the template ../conf/<templatename>.service</br>to generate a systemd config, by replacing the following keywords</br>with global variables that should be defined before calling</br>this helper :</br></br>__APP__       by  $app</br>  __FINALPATH__ by  $final_path</br></br>Requires YunoHost version 2.7.2 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/systemd#L18">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_remove_systemd_config [--service=service]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-s</code>, <code>--service</code> : Service name (optionnal, $app by default)</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.7.2 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/systemd#L54">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_systemd_action" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_systemd_action</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Start (or other actions) a service,  print a log in case of failure and optionnaly wait until the service is completely started</h6>
    </div>
    <div id="collapse-ynh_systemd_action" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_systemd_action [-n service_name] [-a action] [ [-l "line to match"] [-p log_path] [-t timeout] [-e length] ]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-n</code>, <code>--service_name=</code> : Name of the service to start. Default : $app</li>
            
            
            
            <li><code>-a</code>, <code>--action=</code> : Action to perform with systemctl. Default: start</li>
            
            
            
            <li><code>-l</code>, <code>--line_match=</code> : Line to match - The line to find in the log to attest the service have finished to boot. If not defined it don't wait until the service is completely started. WARNING: When using --line_match, you should always add `ynh_clean_check_starting` into your `ynh_clean_setup` at the beginning of the script. Otherwise, tail will not stop in case of failure of the script. The script will then hang forever.</li>
            
            
            
            <li><code>-p</code>, <code>--log_path=</code> : Log file - Path to the log file. Default : /var/log/$app/$app.log</li>
            
            
            
            <li><code>-t</code>, <code>--timeout=</code> : Timeout - The maximum time to wait before ending the watching. Default : 300 seconds.</li>
            
            
            
            <li><code>-e</code>, <code>--length=</code> : Length of the error log : Default : 20</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/systemd#L81">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_clean_check_starting" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_clean_check_starting</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Clean temporary process and file used by ynh_check_starting
(usually used in ynh_clean_setup scripts)</h6>
    </div>
    <div id="collapse-ynh_clean_check_starting" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_clean_check_starting</code>
        
    </p>
    
    
    
    
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/systemd#L167">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_user_exists --username=username</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-u</code>, <code>--username</code> : the username to check</li>
            
            
        </ul>
    </p>
    
    
    
    <p>
        <strong>Example</strong>: <code class="helper-code">ynh_user_exists 'toto' || exit 1</code>
    </p>
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.2.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/user#L11">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_user_get_info --username=username --key=key</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-u</code>, <code>--username</code> : the username to retrieve info from</li>
            
            
            
            <li><code>-k</code>, <code>--key</code> : the key to retrieve</li>
            
            
        </ul>
    </p>
    
    
    <p>
        <strong>Returns</strong>: string - the key's value
    </p>
    
    
    <p>
        <strong>Example</strong>: <code class="helper-code">mail=$(ynh_user_get_info 'toto' 'mail')</code>
    </p>
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.2.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/user#L32">Dude, show me the code !</a>
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
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.4.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/user#L52">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_system_user_exists --username=username</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-u</code>, <code>--username</code> : the username to check</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.2.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/user#L63">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_system_group_exists" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_system_group_exists</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Check if a group exists on the system</h6>
    </div>
    <div id="collapse-ynh_system_group_exists" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_system_group_exists --group=group</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-g</code>, <code>--group</code> : the group to check</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/user#L78">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_system_user_create --username=user_name [--home_dir=home_dir] [--use_shell]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-u</code>, <code>--username</code> : Name of the system user that will be create</li>
            
            
            
            <li><code>-h</code>, <code>--home_dir</code> : Path of the home dir for the user. Usually the final path of the app. If this argument is omitted, the user will be created without home</li>
            
            
            
            <li><code>-s</code>, <code>--use_shell</code> : Create a user using the default login shell if present. If this argument is omitted, the user will be created with /usr/sbin/nologin shell</li>
            
            
        </ul>
    </p>
    
    
    
    
    <p>
    <strong>Examples</strong>:<ul>
        
            
            Create a nextcloud user with no home directory and /usr/sbin/nologin login shell (hence no login capability)
            
            <br>
        
            
            <code class="helper-code">  ynh_system_user_create --username=nextcloud</code>
            
            <br>
        
            
            Create a discourse user using /var/www/discourse as home directory and the default login shell
            
            <br>
        
            
            <code class="helper-code">  ynh_system_user_create --username=discourse --home_dir=/var/www/discourse --use_shell</code>
            
            <br>
        
        </ul>
    </p>
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.6.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/user#L103">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_system_user_delete --username=user_name</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-u</code>, <code>--username</code> : Name of the system user that will be create</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.6.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/user#L137">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>




<h3 style="text-transform: uppercase; font-weight: bold">utils</h3>



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
        This configure the rest of the script execution such that, if an error occurs</br>or if an empty variable is used, the execution of the script stops</br>immediately and a call to `ynh_clean_setup` is triggered if it has been</br>defined by your script.</br></br>Requires YunoHost version 2.6.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/utils#L85">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_setup_source --dest_dir=dest_dir [--source_id=source_id]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-d</code>, <code>--dest_dir</code> : Directory where to setup sources</li>
            
            
            
            <li><code>-s</code>, <code>--source_id</code> : Name of the app, if the package contains more than one app</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        The file conf/app.src need to contains:</br></br>SOURCE_URL=Address to download the app archive</br>SOURCE_SUM=Control sum</br># (Optional) Program to check the integrity (sha256sum, md5sum...)</br># default: sha256</br>SOURCE_SUM_PRG=sha256</br># (Optional) Archive format</br># default: tar.gz</br>SOURCE_FORMAT=tar.gz</br># (Optional) Put false if sources are directly in the archive root</br># default: true</br># Instead of true, SOURCE_IN_SUBDIR could be the number of sub directories</br># to remove.</br>SOURCE_IN_SUBDIR=false</br># (Optionnal) Name of the local archive (offline setup support)</br># default: ${src_id}.${src_format}</br>SOURCE_FILENAME=example.tar.gz</br># (Optional) If it set as false don't extract the source.</br># (Useful to get a debian package or a python wheel.)</br># default: true</br>SOURCE_EXTRACT=(true|false)</br></br>Details:</br>This helper downloads sources from SOURCE_URL if there is no local source</br>archive in /opt/yunohost-apps-src/APP_ID/SOURCE_FILENAME</br></br>Next, it checks the integrity with "SOURCE_SUM_PRG -c --status" command.</br></br>If it's ok, the source archive will be uncompressed in $dest_dir. If the</br>SOURCE_IN_SUBDIR is true, the first level directory of the archive will be</br>removed.</br>If SOURCE_IN_SUBDIR is a numeric value, 2 for example, the 2 first level</br>directories will be removed</br></br>Finally, patches named sources/patches/${src_id}-*.patch and extra files in</br>sources/extra_files/$src_id will be applied to dest_dir</br></br>Requires YunoHost version 2.6.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/utils#L136">Dude, show me the code !</a>
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
        $domain and $path_url should be defined externally (and correspond to the domain.tld and the /path (of the app?))</br></br>Requires YunoHost version 2.6.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/utils#L250">Dude, show me the code !</a>
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
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/utils#L289">Dude, show me the code !</a>
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
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.7.12 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/utils#L305">Dude, show me the code !</a>
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
        
        <strong>Usage</strong>: <code class="helper-code">ynh_secure_remove --file=path_to_remove</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-f</code>, <code>--file</code> : File or directory to remove</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.6.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/utils#L335">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



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
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 2.2.4 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/utils#L378">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_read_manifest" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_read_manifest</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Read the value of a key in a ynh manifest file</h6>
    </div>
    <div id="collapse-ynh_read_manifest" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_read_manifest manifest key</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-m</code>, <code>--manifest=</code> : Path of the manifest to read</li>
            
            
            
            <li><code>-k</code>, <code>--key=</code> : Name of the key to find</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        Requires YunoHost version 3.5.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/utils#L406">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_app_upstream_version" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_app_upstream_version</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Read the upstream version from the manifest</h6>
    </div>
    <div id="collapse-ynh_app_upstream_version" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_app_upstream_version [-m manifest]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-m</code>, <code>--manifest=</code> : Path of the manifest to read</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        The version number in the manifest is defined by <upstreamversion>~ynh<packageversion></br>For example : 4.3-2~ynh3</br>This include the number before ~ynh</br>In the last example it return 4.3-2</br></br>Requires YunoHost version 3.5.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/utils#L434">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_app_package_version" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_app_package_version</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Read package version from the manifest</h6>
    </div>
    <div id="collapse-ynh_app_package_version" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_app_package_version [-m manifest]</code>
        
    </p>
    
    <p>
        <strong>Arguments</strong>:
        <ul>
            
            
            <li><code>-m</code>, <code>--manifest=</code> : Path of the manifest to read</li>
            
            
        </ul>
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        The version number in the manifest is defined by <upstreamversion>~ynh<packageversion></br>For example : 4.3-2~ynh3</br>This include the number after ~ynh</br>In the last example it return 3</br></br>Requires YunoHost version 3.5.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/utils#L458">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>



<div class="helper-card">
  <div class="helper-card-body">
    <div data-toggle="collapse" href="#collapse-ynh_check_app_version_changed" style="cursor:pointer">
        <h5 class="helper-card-title"><tt>ynh_check_app_version_changed</tt></h5>
        <h6 class="helper-card-subtitle text-muted">Checks the app version to upgrade with the existing app version and returns:</h6>
    </div>
    <div id="collapse-ynh_check_app_version_changed" class="collapse" role="tabpanel">
    <hr style="margin-top:25px; margin-bottom:25px;">
    <p>
        
        <strong>Usage</strong>: <code class="helper-code">ynh_check_app_version_changed</code>
        
    </p>
    
    
    
    
    
    <p>
        <strong>Details</strong>:
        <p>
        - UPGRADE_APP if the upstream app version has changed</br>- UPGRADE_PACKAGE if only the YunoHost package has changed</br></br>It stops the current script without error if the package is up-to-date</br></br>This helper should be used to avoid an upgrade of an app, or the upstream part</br>of it, when it's not needed</br></br>To force an upgrade, even if the package is up to date,</br>you have to set the variable YNH_FORCE_UPGRADE before.</br>example: sudo YNH_FORCE_UPGRADE=1 yunohost app upgrade MyApp</br></br>Requires YunoHost version 3.5.0 or higher.</br></br>
        </p>
    </p>
    
    <p>
        <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/helpers.d/utils#L488">Dude, show me the code !</a>
    </p>

  </div>
  </div>

</div>




<p>Generated by <a href="https://github.com/YunoHost/yunohost/blob/stretch-unstable/doc/generate_helper_doc.py">this script</a> on 07/11/2019 (Yunohost version 3.6.4.3)</p>


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
