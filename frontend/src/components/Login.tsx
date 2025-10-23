import type { FormEvent } from "react";
import { useAppSelector, useAppDispatch } from "../hooks";
import { usePostLoginMutation } from "../services/api/userApi";
import { setToken } from "../store/authSlice";
import { getEmail, getPassword, setEmail, setPassword} from "../store/loginFormSlice"

export default function Login() {
  const dispatch = useAppDispatch()
  const [ postLogin, { isLoading } ] = usePostLoginMutation()

  const email = useAppSelector(getEmail)
  const password = useAppSelector(getPassword)

  const onClick = () => postLogin({ email, password }).then(({data}) => dispatch(setToken(data as string)))
  const onSubmit = (event: FormEvent) => {
    event.preventDefault()
    onClick()
  }

  return (
    <div className="Login">
      <div className="splash">
        <h1>CONTRACT SYSTEM</h1>
      </div>
      <form action="/" onSubmit={onSubmit} className="login-form">
          <h1>CONTRACT SYSTEM</h1>
          <h2>Log IN</h2>
          <label>
            <div className="label">Email address</div>
            <input placeholder="Email address" 
              name="email"
              defaultValue={email}
              onChange={e => dispatch(setEmail(e.target.value))} 
            />
          </label>
          <label>
            <div className="label">Password</div>
            <input placeholder="Password" 
              defaultValue={password}
              name="password"
              type="password" 
              onChange={e => dispatch(setPassword(e.target.value))} 
            />
          </label>
          <label><div className="label"><input type="checkbox" /> Remember me</div></label>
          <button onClick={onClick}>{isLoading ? <img src={"/src/assets/tube-spinner.svg"} /> : "Login"}</button>
      </form>
    </div>
  )
}
