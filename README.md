Hanoi
=====

Hanoi is a simplistic yet powerful PHP framework


Installation
------------

Place the folder **hanoi/** on your root project directory and on your **index.php** include the required library file.

```php
<?php
	include('hanoi/core/hanoi.php');
?>
```

**OBS: this code must be place before any HTML content on the page.**


Configure
---------

Hanoi comes with a simple configuration module to activate it do the following:

```php
$config = new Configure(1,1); // 1 - Hanoi debug message, 1 - PHP debug messages
```

Get Help
--------

Does not know what to do with a module, no problem Hanoi can help you. 

Create a new module variable and ask for help:

```php
$database = new Database(); 
echo $database; // will display usage help instructions on your page
```


Version
-------

v0.1b


Author
------

Mariz Melo
mm@emoriz.com


License
-------

Hanoi is open-source, license can be found on this link below:
[http://creativecommons.org/licenses/by-sa/3.0/](http://creativecommons.org/licenses/by-sa/3.0/)

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS 
OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF 
MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE 
COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, 
EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE 
GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING 
NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
OF THE POSSIBILITY OF SUCH DAMAGE.