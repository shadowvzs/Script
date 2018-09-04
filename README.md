# Script
LAMP stack, composer, git, laravel installer script for debian/ubuntu

maybe this will be reorganized

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


## ajax

* **use**: 
	* url - string
	* method - string
	* data - object
	* success - callback function (data)
	* error - callback function (data)

* **output**: 
	* get(url, data, success, error)
	* post(url, data, success, error)
	* raw(setup, success, error)
	* file(url, data, success, null)

* **responsability**:
	* automatically send with request and modify the user hash and domain hash
	* connection between frontend and backend (send/ask data)
	* handle foward the reicived data to callbacks
	* if request got status fail then send **notify** message to user
	* if user rank changed (ex. login/logout) then call visibility render function from view


## notify
* **use**:
	* message - string
	* type - string (default: 'error', 'success', 'normal', 'warning')

* **output**: 
	* add(message, type)
	* remove(id)

* **responsability**:
	* send to user an animated flash message at top-right corner



# Components

* **use**:
	* setup/setting - object literal
	* ajax - ajax object itself

* **output**: 
	* remove() - remove the DOM what component created and remove the event listeners
	* rest depend on component

* **special**: 
	* restriction is must be event target or max 3rd parent of event target
	* component output functions are callable if you put to any element the following:
	* **href="*" data-action="component/${componentname}/${function name}/${string param but its optional}"**

* **responsability**:
	* dynamically handle various tasks and design for that tasks



## Used Component 
* **Calendar**[page] - show/sort/manage data from news and guests table
* **GuestbookComponent**[page] - handle CRUD at guestbook page  
* **AudioPlayer**[perm] - audio player for playing mp3's from database  
* **ContextMenu**[page] - create right click menu and handle it if you send array to this component
* **FileUploader**[page] - file upload and progress bar  
* **AlbumManager**[page] - crud for albums and interact with ContextMenu/FileUploader
* **ImageManager**[page] - crud for images interact with ContextMenu/FileUploader
* **SettingsManager**[perm] - crud for user settings and visual part
* **MessengerComponent**[perm] - crud for messages, message window, periodic message checks
* **UserManagerComponent**[page] - users management and user table

## Component types
* global (pages.global.component)
* page depend (pages.global.component)

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
* currently used component objects saved into pages.current.component[componentName]
* currently used data for components stored into pages.current.componentData[componentName]
* relationship: component can interact with another component output functions
