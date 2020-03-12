#### User Verify Token
    api.post('/users/verifyToken',
      {},
      {
        Authorization: "Bearer " + TOKEN
      }
    )
    
#### User Check is Admin
    api.post('/users/checkAdmin', 
      {},
      {
        Authorization: "Bearer " + TOKEN
      }
    )
    
#### User Check is a Valid User
    api.post('/users/checkUser',
      {},
      {
        Authorization: "Bearer " + TOKEN
      }
    )

**Make sure that the Authorization is not sending by default.**