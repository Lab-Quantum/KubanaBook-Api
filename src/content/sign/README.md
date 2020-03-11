#### Sign In
    api.post('/', {
      section: 'sign',
      action: 'signIn',
      user: NAME / EMAIL / PHONE,
      password: PASSWORD
    })
    
#### User Check is Admin
    api.post('/', {
      section: 'sign',
      action: 'signUP',
      name: NAME,
      email: EMAIL,
      phone: PHONE,
      password: PASSWORD,
      rePassword: REPEAT PASSWORD,
    })
    
*Email or phone can be null*
    
#### User Check is a Valid User
    api.post('/', {
      section: 'sign',
      action: 'signOut'
    })
