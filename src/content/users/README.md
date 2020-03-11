#### User Verify Token
    api.post('/', {
      section: 'users',
      action: 'verifyToken',
      token: TOKEN
    })
    
#### User Check is Admin
    api.post('/', {
      section: 'users',
      action: 'checkAdmin',
      token: TOKEN
    })
    
#### User Check is a Valid User
    api.post('/', {
      section: 'users',
      action: 'checkUser',
      token: TOKEN
    })
