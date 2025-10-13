import { store } from '../../src/store'
import { getEmail, getPassword, setEmail, setPassword } from '../../src/store/loginFormSlice'

test('Store: loginFormSlice', () => {
  expect(getEmail(store.getState())).toBe('');
  expect(getPassword(store.getState())).toBe('');

  store.dispatch(setEmail('a@b.cz'));
  store.dispatch(setPassword('password123'));

  expect(getEmail(store.getState())).toBe('a@b.cz');
  expect(getPassword(store.getState())).toBe('password123');
});

