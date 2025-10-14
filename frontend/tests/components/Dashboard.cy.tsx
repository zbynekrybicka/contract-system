import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import Dashboard from '../../src/components/Dashboard'


describe('Dashboard.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><Dashboard /></Provider>)
  })
})