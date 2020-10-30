API ROUTES
==========

### * POST /register 
	
	Registers users into the database
	* PARAMETERS:
		- name
		
		- password
		
		- role [bawa, super-bawa]

### * POST /login
	
	Logs in an authenticated user
	
	* PARAMETERS
		
		- name
		- password

### * GET /user (protected)
	
	Returns user's info to an authenticated request
	
### * GET /accounts (protected)
		
	Returns all accounts

### * GET /accounts/(account-name) (protected)
	
	Returns details for a specific account

### * GET /transactions	(protected)
	
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

### * GET /transaction/{transaction-id}
	
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

### * GET /account/{account-id}/entry
	
	Returns all entries for an account

	```
	{
		'entry-id': "123",
		'user': "user",
		'amount': "123",
		'desc': "some description",
		'debit': 0,
		'credit': 1000,
		'date': DATE
	},
	...,
	...,
	```

### * GET /account 
	
	Returns all accounts

	```
	{
		{
			"id": "someRaNd0mStR1nG",
			"name": "ACC#1",
			"owner": "user",
			"desc": "some descrption for account",
			"date": "date on which it was created",
			"debit": entry[],
			"credit": eentry[]
		},
		...,
		...,
	}
	```

### * POST /account
	Create an account

### * POST /account/{d/c}/{entry}/
	Adds entry into account


Transaction Use Case
====================

- UserA deposits 5000 into Budget Account

	- POST /account/Budget/d/entry
		```
		{
			'account': 'budget',
			'entry-id': "123",
			'user': "UserA",
			'amount': "5000",
			'desc': "Amount for budget FTM March-2020",
			'date': DATE
		},
		```
	- Transaction is created
		```
		{
			'id': "a3fc23ce",
			'from': "UserA",
			'to': "House",
			'to-id': "entry-id",
			'from-id': '123',
			'balance': "2300",
			'desc': "some description",
			'type': "BORROWED | HOUSE | EXPENSE",
			'date': DATE
		}
		```



Accounts and Entries
=======================

For every account (table), there will be a corresponding entries (table). eg: BudgetAccount will have BudgetAccountEntries. This information will be stored in a table, EntriesLookup. 



TEST CASES
==========

1) Login 
2) Register


NOTE TO SELF
============

Create a resource named account to transform response. 
(p.352)