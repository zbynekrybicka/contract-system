import { useAppSelector, useAppDispatch } from "../hooks";
import { usePostLoginMutation } from "../services/api/authApi";
import { setToken } from "../store/authSlice";
import { getEmail, getPassword, setEmail, setPassword} from "../store/loginFormSlice"

export default function Login() {
  const dispatch = useAppDispatch()
  const [ postLogin ] = usePostLoginMutation()

  const email = useAppSelector(getEmail)
  const password = useAppSelector(getPassword)

  return (
    <div>
      <input placeholder="email" 
        defaultValue={email}
        onChange={e => dispatch(setEmail(e.target.value))} 
      />
      <input placeholder="password" 
        defaultValue={password}
        type="password" 
        onChange={e => dispatch(setPassword(e.target.value))} 
      />
      <button onClick={() => postLogin({ email, password }).then(({data}) => dispatch(setToken(data as string)))}>Login</button>
    </div>
  )
}
