import { useState, type ChangeEvent, type FormEvent } from "react";
import { useAppDispatch } from "../hooks";
import { usePostLoginMutation, type PostLoginResult } from "../services/api/userApi";
import { setToken } from "../store/authSlice";

export default function Login() {
  const dispatch = useAppDispatch()

  
  /**
   * Email
   * Password
   * Remember Me
   */
  const [ email, setEmail ] = useState<string>("")
  const [ password, setPassword ] = useState<string>("")
  const [ rememberMe, setRememberMe ] = useState<boolean>(false)


  /**
   * Set Email
   * Set Password
   * Set Remember Me
   */
  const handleSetEmail: (event: ChangeEvent<HTMLInputElement>) => void = e => setEmail(e.target.value)
  const handleSetPassword: (event: ChangeEvent<HTMLInputElement>) => void = e => setPassword(e.target.value)
  const handleSetRememberMe: (event: ChangeEvent<HTMLInputElement>) => void = e => setRememberMe(e.target.checked)


  /**
   * POST /login
   */
  const [ postLogin, { isLoading } ] = usePostLoginMutation()  
  const handleSendForm = (event: FormEvent) => {
    event.preventDefault()
    postLogin({ email, password }).then(({data}: PostLoginResult) => {
      if (data) {
        dispatch(setToken(data))
      }
    })
  }


  return (
    <div className="Login">
      <div className="splash">
        <h1>CONTRACT SYSTEM</h1>
      </div>
      <form action="/" onSubmit={handleSendForm} className="login-form">
          <h1>CONTRACT SYSTEM</h1>
          <h2>Log IN</h2>
          <label>
            <div className="label">Email address</div>
            <input placeholder="Email address" name="email" defaultValue={email} onChange={handleSetEmail} />
          </label>
          <label>
            <div className="label">Password</div>
            <input placeholder="Password" defaultValue={password} name="password" type="password" onChange={handleSetPassword} />
          </label>
          <label><div className="label"><input type="checkbox" defaultChecked={rememberMe} onChange={handleSetRememberMe} /> Remember me</div></label>
          <button>{isLoading ? <img src={"/src/assets/tube-spinner.svg"} /> : "Login"}</button>
      </form>
    </div>
  )
}
