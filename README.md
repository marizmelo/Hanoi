Hanoi
=====

Hanoi is a simplistic yet powerful PHP framework


Installation
------------

Place the folder **hanoi/** on your root project directory and on your **index.php** include the required library file.

    include('/hanoi/core/hanoi.php');


How to use
----------

After complete the installation step you can start using Hanoi simple by creating new objects using the available classes inside **/hanoi/core** folder.

Example:

```php
    // CONNECTION WITH DATABASE
    $data = new Database(1,1); // 1,1 are optional arguments, the first one initiates the embedded debug system, and the second activate PHP default debug system
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