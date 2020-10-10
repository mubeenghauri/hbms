API ROUTES
==========

* POST /register 
	Registers users into the database
	** PARAMETERS:
		- name
		- password
		- role [bawa, super-bawa]

* POST /login
	
	Logs in an authenticated user
	
	** PARAMETERS
		
		- name
		- password

* GET /user (protected)
	
	Returns user's info to an authenticated request
	
* GET /accounts (protected)
		
	Returns all accounts

* GET /accounts/(account-name) (protected)
	
	Returns details for a specific account

* GET /transaction	(protected)
	
	Returns all transactions concerned to the user

	```
	{
		{
			'id': "a3fc23ce",
			'from': "user1",
			'to': "user2",
			'to-id': "entry-id",
			'from-id': 'entry-id',
			'balance': "2300",
			'desc': "some description"
		},
		...,
		...,
	}
	```

* GET /transaction/{transaction-id}
	
	Returns details of transaction for the given id
	```	
	{
			'id': "a3fc23ce",
			'from': "user1",
			'to': "user2",
			'to-id': "entry-id",
			'from-id': 'entry-id',
			'balance': "2300",
			'desc': "some description",
			'type': "BORROWED | HOUSE | EXPENSE",
			'date': DATE
	}
	```

* GET /entry/{account-id} 
	
	Returns all entries for an account

	```
	{
		'entry-id': "123",
		'user': "user",
		'amount': "123",
		'desc': "some description",
		'date': DATE
	}
	```
* GET /account 
	
	Returns all accounts

	```
	{
		{
			"id": "someRaNd0mStR1nG",
			"name": "ACC#1",
			"owner": "user",
			"debit": entry[],
			"credit": eentry[]
		},
		...,
		...,
	}
	```

* POST /account
	Create an account

