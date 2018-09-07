# Script
LAMP stack, composer, git, laravel installer script for debian/ubuntu


## Isolation
Every object was created inside **App** iife function



## Main objects:
*except components & pages, every object will be constructed only once*

* **ajax** - constructor Ajax()
* **middleware** - constructor Middleware()
* **router** - constructor Router()
* **model** - constructor Model(middleware)
* **view** - constructor View(middleware)
* **controller** - constructor (middleware, model, view)
* **notify** - constructor Notify()


## Special Objects
* **pages** - object literal about page behaviours 
* **components** - *each component got his own constructor*

--------------------------------------

# ajax
<details>
<summary> show/hide </summary>
	
* **input param**: 
	* url - string
	* method - string
	* data - object
	* success - callback function (data)
	* error - callback function (data)

* **output property**: 
	* get(url, data, success, error)
	* post(url, data, success, error)
	* raw(setup, success, error)
	* file(url, data, success, null)

* **role**:
	* automatically send with request and modify the user hash and domain hash
	* connection between frontend and backend (send/ask data)
	* handle foward the reicived data to callbacks
	* if request got status fail then send **notify** message to user
	* if user rank changed (ex. login/logout) then call visibility render function from view
</details>

# notify
<details>
<summary> show/hide </summary>
	
* **use**:
	* message - string
	* type - string (default: 'error', 'success', 'normal', 'warning')

* **output**: 
	* add(message, type)
	* remove(id)

* **responsability**:
	* send to user an animated flash message at top-right corner
</details>

# router
<details>
<summary> show/hide </summary>
* **output property**: 
	* url() - return object (properties: base_path, base_url, url_array, query_string, query_array)
	* redirect(newUrl, title=null, obj=null) - redirect the page (call setPage from Controller)
	* setFullUrl(newUrl) - change url without other action
	* setUrl(urlAddon) - change url based on urlAddon (modelComponent use this option)
	* init() - delayed redirect()

* **note**:	
	* Appache .htaccess redirect everything to index.php so the url will be handled by Router object what got a contructor function and later will be created the instance 

* **role**:
	* manage history part (push state)
	* manage back button event


## Router in action
	
* You must define the available routes in Router constructor function like:
```
		routes = [
			/*
				which got * it is optional, not required!
				url(0): prefix*/model/action*/:param*
				prefix(1) - optional (use false if you don't use)
				auth(2)	  - required role level (null/false=public page)
				prefix(3)  - validation for params (ex: NUMBER/SLUG)
			*/
			//            0               1    2    3    
			['/admin/user/edit/:id/', 'admin', 3, ['NUMBER']],
			['/gallery/album/:slug/:index', false, null, ['SLUG','NUMBER']],
		];
```
* If current url structure match with anything (**validateRoute**) from routes array then call setPage method in Controller
	* if pages.model_action exist then build the page with model & view
		* pages_model_action got information about page name, if required mode data, which component use that page etc
	* else redirect to error page ( with id 404)
* Router have a global click event what check if current element/or his parent element have href attribute, if check if the link was one from following link type:
    * Redirect (internal) then push into history and replace url, call the setPage method
		* **/home**
    * Component then send data to popUpRender method in View object
		* **href="*" data-action="component/youtubeViewer/show/1"**
    * Toggle - toggle an element by id
		* **href="*" data-action="toggle/audioPlayer"**
    * SelectAll - toggle an element
		* **href="*" data-action="selectAll/"**
    * Submit collect input data and send to server (ex. login/registration)
		* **href="*" data-action="submit/login"**
    * else - normal link, jump to another site/server/domain
		* **href="https://google.com"**
</details>

# model
<details>
<summary> show/hide </summary>
	
* **input param**: 
	* nothing at moment but could be injected view or router

* **output property**: 
	* getPageData(controller, action, param) 
		* those data from url, like /user/edit/2
	* submitForm(formId, url, extraDataObject, successHandler)
		* formId - id on form element, which contain the form data fields
		* url - string
		* extraDataObject - object[optional] what we want insert into form datas
		* successHandler - function[optional] we can assign handler function if needed else backend must send which handle needed for processing the returned data
	* getCustomData(apiKey, param)
		* apiKey - string key for for Api object inside of model object
		* param what we send to api

* **role**:
	* this is the data source with ajax, send/ask data from backend
	* depend on function what we use, could be:
		* sending data to api and handle the request with inbuilt api functions
		* sending form:
			* gather every input, select, textarea inside of form element
			* validate data if data got rules and give error if something wrong:
				* **everything what you validate here, must validate in backend too!!**
				* attributes what needed for validation:
					* **id**: must have same prefix than form name
						* ex. form is loginForm, then email field id is login_email
					* **name**: same like id, must have same prefix
						* when we send data then form prefix cutted and param became the remaining string:
						* ex. **name="login_email"** when u send became **email=" *input value* "**
					* **title**: well, this is only optional but could be usefull
						* when validation fail and we have title then we send this message to user and not validator error message
					* **validators**: used for validate the inputs with predefined rules:
						* **data-rule="EMAIL,5,50"** - email validator
							* EMAIL: regex pattern name, see **regex patterns**
							* 5: minimum length
							* 50: maximum length
						* **data-same="signup_password"** - element id - compare this element value with another element value
				* complete example: 		
```
				<input id="login_email" name="login_email" type="text" placeholder="Email cím" title="Kérem adjon meg egy valós email címet" data-rule="EMAIL,5,50">
```					
</details>



# middleware
<details>
<summary> show/hide </summary>
* **output property**: 
	* add (label, callback=null) - assign callback under this object where key is the label
	* run(label, data) - call assigned callback and pass data into those callbacks
	* remove(label) - remove assigned callback property from this object

* **role**:
	* bridge between controller and router (injected to both constructor)

## Middleware in action
	
* assign function from controller
```
	middleware.add('redirect', setPage);
```
* run assigned function 
```
	middleware.run("redirect", data );
```
</details>

--------------------------------------

# Constants and Regex pattern
<details>
<summary> show/hide </summary>

* note: maybe this will be changed by time
* constants: 
	* path:
		* debug: function(data) - write data to console log
		* BASE_PROTOCOL: http or https
		* BASE_HOSTNAME: hostname
		* BASE_ROOT: base root
		* MODEL_PATH: path for backend model
		* IMAGE_PATH: image folder path 
		* GALLERY_PATH: image gallery folder path 
		* THUMBNAIL_PATH: image gallery thumbnail folder path 
		* MENU_ICON_PATH: menu icon folder path 
		* USER_STATUS: array (Inactive,Active,Banned,Deleted)
		* USER_RANK: array(Guest,Member,Moderator,Admin,Owner)
		* INTERNAL_ERROR_URL: url for error 500 - internal error page 
		* NOT_FOUND_URL: url for error 404 - not found page 
		* NO_ACCESS_URL: url for error 403 - forbidden page
		* ERROR_MSG{id:message}: error message based on error id 
		* MOUSE_BUTTON: for make difference for normal left click
		* SERVER_TIME_ZONE: GMT+x sec, example 7200 = GMT+3
		* CLIENT_TIME_ZONE: image folder path
		* ALLOWED_STATUS_DIFFERENCE: limit in sec which used to define user is online or offline
		* VALIDATOR: regex pattern for **router** and **model** (form validator)
			* NUMBER, PHONE, ALPHA, ALPHA_NUM, STR_AND_NUM, LOW_UP_NUM, SLUG, NAME, NAME_HUN, ADDRESS_HUN, STRING, EMAIL, IP
			* example:
```
			'STR_AND_NUM': /^([0-9]+[a-zA-Z]+|[a-zA-Z]+[0-9]+|[a-zA-Z]+[0-9]+[a-zA-Z]+)$/
```		
</details>

# Pages
<details>
<summary> show/hide </summary>

* **input/output param**:
	* not exist because it object literal

* **role**:
	* contain the page and core (view related) infos, main categories:
		* global - common data:
			* components (permanent components)
			* cache (maybe will be removed)
		* current - common data for current page:
			* routerData (current controller, action, param, data)
			* dom (content dom cache)
			* bone (content dom string content)
			* title
			* data (maybe will be removed, used for image cache)
			* component (page related component)
			* componentData (if component must store data - see **components** )
		* controller_action (page related data, ex: article_index - see **router** )
			* title (page title, sevaral page overwrite this, ex. gallery/article)
			* render (if missing then it is same than model: false)
				* model 
					* boolean: if we need data or no, file name is the controller name, method name will be action
					* string: if data coming from outside, like example youtube playlist coming from youtube api
			* template (string key which, which template function we use in view for create that page)
			* component (object - it is setup data for components - see **components** )
			* example: 
```
				user_index: {
					title: "Felhasználók",
					render: {
						model: true,
					},
					component: {
						userManager: {
							name: 'userManager',
							condition: {
								role: 3
							},
							table: '.user .index main table',
							storeData: true,
							datasource: {
								edit: MODEL_PATH+'User.php?action=admin_edit',
								delete: MODEL_PATH+'User.php?action=delete_user',
							},
							constructor: UserManagerComponent
						}
					},
					template: 'usersPage',
				},
```			
## Description
* pages object verified by Controller 
	* model render missing or false: then will call automatically View.build();
	* model render is string: then call the model.getCustomData(render.model, param);
	* model render is true: then call the model.getPageData(controller, action, param);
		* in this case backend send in response which View render function(s) must used for page
		* example, this call View.build(data):
```
		class Article extends Model {
			public function index($data=null) {
				// code code code
				return $this->sendResponse([$articles, 0], 'build');
			}
		}
```			
* pages object used in View object in build method ( see **view** )
</details>

# Components
<details>
<summary> show/hide </summary>

* **input param**:
	* setup/setting - object literal
	* ajax - ajax object itself

* **output property**: 
	* remove() - remove the DOM what component created and remove the event listeners
	* rest depend on component

* **special**: 
	* restriction is must be event target or max 3rd parent of event target
	* component output functions are callable if you put to any element the following:
	* **href="*" data-action="component/${componentname}/${function name}/${string param but its optional}"**

* **role**:
	* dynamically handle a special task like managing user table:
		* ex. delete user from table & database or change data on user
	
* **note**:
	* javascript constructor function what will be initialized with **new** key
	* components don't have css
	* each component have HTML part: 
		* a template constant where the HTML stored in template function
		* is template is shared then could get HTML string from View object 
			* ex. view.getContent(key, data);


## Used Component 
* **ModalComponent**[perm] - modal what let manage url & the content
* **SettingsManager**[perm] - crud for user settings and visual part
* **AudioPlayer**[perm] - audio player for playing mp3's from database  
* **MessengerComponent**[perm] - crud for messages, message window, periodic message checks
* **Calendar**[page] - show/sort/manage data from news and guests table
* **GuestbookComponent**[page] - handle CRUD at guestbook page  
* **ContextMenu**[page] - create right click menu and handle it if you send array to this component
* **FileUploader**[page] - file upload and progress bar  
* **AlbumManager**[page] - crud for albums and interact with ContextMenu/FileUploader
* **ImageManager**[page] - crud for images interact with ContextMenu/FileUploader
* **UserManagerComponent**[page] - users management and user table
* **YoutubeViewerComponent**[page] - create youtube video iframe for modal and pass new url
* **ImageViewerComponent**[page] - create image with carousel for modal and pass new url

## Component types (2)

* global (pages.global.component) 
	* created at page loading
	* removed only if component have condition and user role changed
	
* page depend (pages.global.component) 
	* created when user click to an internal page link
	* removed when user change the current page 

## Component setup/settings
* structure: object literal
* properties: common or special 
* common properties: 
	* name - string (component name, same than )
	* condition - object (at moment only role level condition exist)
	* datasource - object (if component need interact with backend, we store here the url's)
	* storeData - boolean (if it is true then page data will be saved under pages.current.componentData)
	* relationship - string (another component name, which we will use for something)
	* constructor - function (component constructor function)
	* example: 
```
	component: {	
		settingsManager: {
			name: 'settingsManager',
			condition: {
				role: 1
			},
			datasource: {
				get: MODEL_PATH+'User.php?action=get_my_data',
				edit: MODEL_PATH+'User.php?action=edit',
			},
			constructor: SettingsManager
		}
	}
```

## Components in action
* component will be initialized in View.Build() (except global components)
* global components are verified everytime if user role changed
* currently used component objects saved into pages.current.component[componentName]
* currently used data for components stored into pages.current.componentData[componentName]
* relationship: component can interact with another component output functions
	* examples: 
		* imageViewer set content and define url for modalComponent
		* imageManager set content for right-click contextMenu
</details>
