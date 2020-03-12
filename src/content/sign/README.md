#### Sign In
    api.post('/sign/signIn', {
      user: NAME / EMAIL / PHONE,
      password: PASSWORD
    })
    
#### User Check is Admin
    api.post('/sign/signUp', {
      name: NAME,
      email: EMAIL,
      phone: PHONE,
      password: PASSWORD,
      rePassword: REPEAT PASSWORD,
    })
    
*Email or phone can be null*
    
#### User Check is a Valid User
    api.post('/sign/signOut')
