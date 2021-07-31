## Steps

First is create a local db named arte then
<div>
<pre> composer install </pre>
</div>
 to install the vendor files.

Second create an .env
<div>
<pre>cp .env.example .env</pre>
    </div>
 then follow from this.

<div>
<pre>php artisan key:generate</pre>
    </div>

Lastly is to migrate the fields
<div>
<pre>php artisan migrate</pre>
    </div>

then
<div>
<pre>php artisan serve --host {yourIPv4}</pre>
    </div>

